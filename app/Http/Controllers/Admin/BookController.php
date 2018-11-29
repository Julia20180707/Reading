<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Chapter;
use App\Classify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //加载后台主页
    public function index()
    {
        if (!\Auth::guard("admin")->check()) {
            return redirect("/admin/login");
        }
        return view("admin/index");
    }

    /** 分类管理模块开始 **/

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

    /** 分类管理模块结束 **/


    /** 书籍管理模块开始 **/

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

        if (!count($res)) {
            //数据库author表中没有作者信息  需要先向表中添加该作者信息
            $user_create = ['name' => $request->author];
            $user = Author::create($user_create);
            $user_id = $user->id;
        } else {
            //数据库中有作者信息  authors
            $user_id = DB::select("select id from authors where name=" . "'" . $request->author . "'")[0]->id;
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
        while ($i <= $all) {
            $fn = readdir($handle);
            if ($fn != '.' && $fn != '..') {
//                echo "<br>将名为：" . $fn . "\n\r";
                $curDir = $dirname . '/' . $fn;
                if (is_dir($curDir)) {
                    $this->fRename($curDir);
                } else {
                    $path = pathinfo($curDir);
                    $name = $this->msectime();
                    $data['chapter_id'] = $i;
                    $data['chapter_name'] = $name;
                    Chapter::create($data);
                    $newname = $path['dirname'] . '/' . $name . '.' . $path['extension'];
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

    //加载管理所有书籍页面
    public function books_manage()
    {
        $books = Book::paginate(10);
        $classifies = Classify::get();
        return view("admin/book/books", compact("books", "classifies"));
    }

    //加载修改书籍信息页面
    public function book_edit($id)
    {
        $book = Book::find($id);
        $classifies = Classify::get();
        return view("admin/book/book_edit", compact("book", 'classifies'));
    }

    //保存书籍信息修改
    public function book_save(Request $request)
    {
        $data = $request->except('_token', 'author');
//        dd($request->file('cover_pic'));

        $res = DB::table('users')->where('name', $request->author)->get();
        if (!count($res)) {
            //数据库author表中没有作者信息  需要先向表中添加该作者信息
            $user_create = ['name' => $request->author];
            $user = Author::create($user_create);
            $user_id = $user->id;
        } else {
            //数据库中有作者信息  则从authors表中查询该作者的id
            $user_id = DB::select("select id from authors where name=" . "'" . $request->author . "'")[0]->id;
        }

        $data['author_id'] = $user_id;

        // 图片上传路径
        $pic_path = $request->file("cover_pic")->store("cover_pics");
        $data['cover_pic'] = $pic_path;

        //删除原图
        $old_img = Book::find($request->id)->get()[0]->cover_pic;
        unlink($old_img);

        DB::table('books')
            ->where('id', $request->id)
            ->update($data);

        return $this->book_edit($request->id);
    }

    //加载上传章节页面
    public function upload_chapter()
    {
        return view("admin/book/upload_chapter");
    }

    //保存上传的章节
    public function chapter_save(Request $request)
    {
        $author_id = Author::where('name', $request->author)->get()[0]->id;
        $book = Book::where(['title'=>$request->book_name, 'author_id'=>$author_id])->get()[0];
        $book_id = $book->id;
        $data = $request->only('chapter_id');
        $data['book_id'] = $book_id;

        //上传章节
        $path = $request->file("chapter")->store(iconv ( 'UTF-8', 'GB2312', "books/" . $book->directory . '/' . $book->title));
        $old_name = "books/" . $book->directory . '/' . $book->title . '/' . last(explode('/', $path));

        $chapter_name = $this->msectime();
        $data['chapter_name'] = $chapter_name;

        $new_name = "books/" . $book->directory . '/' . $book->title . '/' . $chapter_name . '.txt';
        rename(iconv ( 'UTF-8', 'GBK', $old_name), iconv ( 'UTF-8', 'GBK', $new_name));

        //chapters表中插入新数据
        Chapter::create($data);
        return $this->upload_chapter();
    }

    /** 书籍管理模块结束 **/
}
