<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Chapter;
use App\Classify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index()
    {

        return view("admin/index");
    }

    /* 分类管理模块开始 */

    //管理分类
    public function classify()
    {
        $classifies = Classify::get();
        return view("admin/book/classify", compact("classifies"));
    }

    //删除某分类
    public function classify_delete($id)
    {
        Classify::destroy($id);
        return $this->classify();
    }

    //添加分类
    public function classify_add(Request $request)
    {
        $data = $request->except("_token");
        Classify::create($data);
        return $this->classify();
    }

    //加载编辑分类页面
    public function classify_edit($id)
    {
        $classify = Classify::find($id);
        return view("admin/book/classify_edit", compact("classify"));
    }

    //保存分类
    public function classify_save(Request $request)
    {
        Classify::where("id", $request->id)->update(["title" => $request->title]);
        return $this->classify();
    }

    /* 分类管理模块结束 */




    /* 书籍管理模块 */

    //加载上传新书页面
    public function upload()
    {
        $classifies = Classify::get();
        return view("admin/book/upload", compact("classifies"));
    }

    //上传新书
    public function books_upload(Request $request)
    {
        $data = $request->except('_token', 'author', 'book_content', 'cover_pic');
        $res = DB::table('users')->where('name', $request->author)->get();
//        $res = DB::select("select * from users where name=" . "'" . $request->author . "'");
        if (!count($res)) {
            //数据库中没有作者信息  需要先向users表中添加该作者信息
            $user_create = ['name' => $request->author];
            $user = User::create($user_create);
            $user_id = $user->id;
        } else {
            //数据库中有作者信息  则从users表中查询该作者的id
            $user_id = DB::select("select id from users where name=" . "'" . $request->author . "'")[0]->id;
        }

        $data['author_id'] = $user_id;

        $p = $request->file("book_content")->store("zip");
        $path = explode("/", $p)[1];

        //提取压缩文件名中除去 ".zip" 的部分作为目录存储在books表中
        $directory = explode(".", $path)[0];

        $data['directory'] = $directory;

        // 图片上传路径
        $pic_path = $request->file("cover_pic")->store("cover_pics");
        $data['cover_pic'] = $pic_path;

        $book = Book::create($data);

        //将上传的压缩包解压到books目录 解压成功返回true  失败返回false
        //'books/' 文件夹为解压目录   'zip/'为压缩文件专用目录(若需要可随时清空)
        $unzip = $this->unzip("zip/" . $path, 'books/');

        //解压成功后重命名所有章节名
        if ($unzip) {
            //重命名文件所在目录
            $dir = 'books\\' . $directory . '\\' . $request->title;
            //需要重命名的文件总数
            $arr = scandir(iconv ( 'UTF-8', 'GB2312', $dir));
            $all = count($arr)-2;
            //执行重命名(同时将重命名的新文件名存入chapter表中)
            $this->fRename(iconv ( 'UTF-8', 'GB2312', $dir), $all, $book->id);
        }

        return $this->upload()->with(123);
    }

    /**
     * 解压文件到指定目录
     *
     * @param  string  zip压缩文件的路径
     * @param  string  解压文件的目的路径
     * @param  boolean 是否以压缩文件的名字创建目标文件夹
     * @param  boolean 是否重写已经存在的文件
     *
     * @return boolean 返回成功 或失败
     */
    /*public function unzip($src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true){
        if ($zip = zip_open($src_file)){
            if ($zip){
                $splitter = ($create_zip_name_dir === true) ? "." : "/";
                if($dest_dir === false){
                    $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";
                }
                // 如果$dest_dir存在 创建目标解压目录
                $this->create_dirs($dest_dir);
                // 对每个文件进行解压
                while ($zip_entry = zip_read($zip)){
                    // 文件不在根目录
                    $pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
//                    $create_dir = explode(".", $dest_dir)[0] . '/';
                    if ($pos_last_slash !== false){
                        // 创建目录 在末尾带 /
                        $this->create_dirs($dest_dir.substr(zip_entry_name($zip_entry), 0, $pos_last_slash+1));
//                        $this->create_dirs($create_dir);
                    }
                    // 打开包
                    if (zip_entry_open($zip,$zip_entry,"r")){
                        // 文件名保存在磁盘上
                        $file_name = $dest_dir.zip_entry_name($zip_entry);
//                        $file_name = $create_dir;
                        // 检查文件是否需要重写
                        if ($overwrite === true || $overwrite === false && !is_file($file_name)){
                            // 读取压缩文件的内容
                            $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                            @file_put_contents($file_name, $fstream);
                            // 设置权限
                            chmod($file_name, 0777);
                            // echo "save: ".$file_name."<br />";
                        }
                        // 关闭入口
                        zip_entry_close($zip_entry);
                    }
                }
                // 关闭压缩包
                zip_close($zip);
            }
        }else{
            return false;
        }
        return true;
    }*/

    /**
     * 创建目录
     */
    /*public function create_dirs($path){
        if (!is_dir($path)){
            $directory_path = "";
            $directories = explode("/",$path);
            array_pop($directories);
            foreach($directories as $directory){
                $directory_path .= $directory."/";
                if (!is_dir($directory_path)){
                    mkdir($directory_path, 0777);
//                    chmod($directory_path, 0777);
                }
            }
        }
    }*/

    /*public function unzip()
    {
        //zip文件名
        $fileName = '逆风的吻.zip';
        //zip文件相对服务器根目录的保存路径
        $uploads_dir = "/zip";

        //zip文件完整的保存路径
        $zipName = $_SERVER['DOCUMENT_ROOT'].$uploads_dir.'/'.$fileName;
        //将目标路径名称赋值为fileName最后的'.zip'四个字符之外的全部字符构成的字符串
        $toDir = $_SERVER['DOCUMENT_ROOT'].$uploads_dir.'/'.substr($fileName,0,strlen($fileName)-4);

        $zip = new \ZipArchive;//新建一个ZipArchive的对象

        //通过ZipArchive的对象处理zip文件
        //$zip->open这个方法的参数表示处理的zip文件名。
       //如果对zip文件对象操作成功，$zip->open这个方法会返回TRUE

        $res = $zip->open(iconv ( 'UTF-8', 'GB2312', $zipName));
        if ($res === TRUE){
            if (!is_dir(iconv ( 'UTF-8', 'GB2312', $toDir))) {
                mkdir(iconv ( 'UTF-8', 'GB2312', $toDir), 0777, true);
            }
            //$zip->extractTo($toDir);
            $docnum = $zip->numFiles;
            for($i = 0; $i < $docnum; $i++) {
                $statInfo = $zip->statIndex($i);
                if($statInfo['crc'] == 0) {
                    //新建目录
                    mkdir(iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name']), 0777, true);
                } else {
                    //拷贝文件,特别的改动，iconv的位置决定copy能不能work
                    if(copy('zip://'.iconv ( 'UTF-8', 'GB2312', $zipName).'#'.$statInfo['name'], iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name'])) == false){
                        echo 'faild to copy';
                    }
                }
            }

            print_r(scandir(iconv ( 'UTF-8', 'GB2312',$toDir)));
            $zip->close();//关闭处理的zip文件
        }
        else{
            echo 'failed, code:'.$res.'<br>';
        }
    }*/

    /**
     * 解压文件到指定目录
     * @param $zipName   string   zip文件完整的保存路径
     * @param $to        string   解压文件的目的路径
     *
     * @return boolean 返回成功 或失败
     * */
    public function unzip($zipName,$to)
    {
        $arr = explode('/', $zipName);
        $fileName = end($arr);
        //将目标路径名称赋值为fileName最后的'.zip'四个字符之外的全部字符构成的字符串
        $toDir = $to . substr($fileName,0,strlen($fileName)-4);

        $zip = new \ZipArchive;//新建一个ZipArchive的对象

        $res = $zip->open(iconv ( 'UTF-8', 'GB2312', $zipName));
        if ($res === TRUE){
            if (!is_dir(iconv ( 'UTF-8', 'GB2312', $toDir))) {
                mkdir(iconv ( 'UTF-8', 'GB2312', $toDir), 0777, true);
            }
            $docnum = $zip->numFiles;
            for($i = 0; $i < $docnum; $i++) {
                $statInfo = $zip->statIndex($i);
                if($statInfo['crc'] == 0) {
                    //新建目录
                    mkdir(iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name']), 0777, true);
                } else {
                    //拷贝文件,特别的改动，iconv的位置决定copy能不能work
                    if(@copy('zip://' . iconv ( 'UTF-8', 'GB2312', $zip->filename).'#'.$statInfo['name'], iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name'])) == false){
                        //echo 'faild to copy';
                    }
                }
            }
            $zip->close();//关闭处理的zip文件
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * 遍历目录中所有文件和文件夹，修改文件名
     * @param $dirname
     * @param $all  目录下的文件总数
     */
    function fRename($dirname, $all, $book_id)
    {
        $data['book_id'] = $book_id;
        if (!is_dir($dirname)) {
            echo "{$dirname}不是一个有效的目录！";
            exit();
        }
        $handle = opendir($dirname);

        $i = 1;

//        while (($fn = readdir($handle)) !== false) {
        while ($i <= $all) {
            $fn = readdir($handle);
            if ($fn != '.' && $fn != '..') {
//                echo "<br>将名为：" . $fn . "\n\r";
                $curDir = $dirname . '/' . $fn;
                if (is_dir($curDir)) {
                    $this->fRename($curDir);
                } else {
                    $path = pathinfo($curDir);
                    //改成你自己想要的新名字
                    $name = $this->msectime();

                    $data['chapter_id'] = $i;
                    $data['chapter_name'] = $name;

                    Chapter::create($data);

                    $newname = $path['dirname'] . '/' . $name . '.' . $path['extension'];
//                    echo "替换成:" . $name . '.' . $path['extension'] . "\r\n";
                    rename($curDir, $newname);
                    $i++;
                }
            }
        }
    }


    /**
     * 生成当前秒数和微秒数组合成的唯一字符串作为章节名
     */
    function msectime() {
        //如果调用时不带可选参数，microtime()以 "msec sec" 的格式返回一个字符串，其中 sec 是自 Unix 纪元（0:00:00 January 1, 1970 GMT）起到现在的秒数，msec 是微秒部分。字符串的两部分都是以秒为单位返回的。
        //microtime() => 0.25139300 1138197510

        list($msec, $sec) = explode(' ', microtime());
        $msectime = $sec . ( (string)$msec * pow(10, 6) );

        return $msectime;
    }
}
