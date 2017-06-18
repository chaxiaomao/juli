<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class categoryController extends Controller
{
    public function getList()
    {
        $categorys = Category::all();
        return view('admin.category_list')->with('categorys', $categorys);
    }

    public function getAdd()
    {
        $categorys = Category::all();
        return view('admin.category_add')->with('categorys', $categorys);
    }

    public function postAdd()
    {
        $category = new Category();
        $name = $_POST['name'];
        if ($name == '') {
            return '<script>alert("名字不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        $category->name = $name;
        $category->category_id = $_POST['category_id'];
        $category->save();
        return '<script>
            alert("添加成功");
//            var index = parent.layer.getFrameIndex(window.name);
//            parent.layer.close(index);
            parent.location.reload();
        </script>';
    }

    public function getEdit()
    {
        $category = Category::find($_GET['id']);
        return view('admin.category_edit')->with('category', $category);
    }

    public function postEdit()
    {
        $name = $_POST['name'];
        if ($name == '') {
            return '<script>alert("名字不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        $category = Category::find($_POST['id']);
        $category->name = $name;
        $category->save();
        return '<script>
            alert("修改成功");
            parent.location.reload();
        </script>';
    }
}