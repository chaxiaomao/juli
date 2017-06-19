<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\PdtContent;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function getList(Request $request)
    {
        $category_id = $request->input('id', 1);
        $products = Product::where('category_id', $category_id)->get();
        $categorys = Category::all();
        return view('admin.product_list')->with('products', $products)
            ->with('categorys', $categorys);
    }

    public function getAdd()
    {
        $categorys = Category::where('status', 0)->get();
        return view('admin.product_add')->with('categorys', $categorys);
    }

    public function postAdd()
    {
        $name = $_POST['name'];
        $summary = $_POST['summary'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $content = $_POST['content'];
        if ($name == '') {
            return '<script>alert("名字不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        if ($price == '') {
            return '<script>alert("价格不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        $product = new Product();
        $product->name = $name;
        $product->summary = $summary;
        $product->category_id = $category_id;
        $product->price = $price;
        $product->preview = $_POST['preview'];
        $product->save();
        $pdt_content = new PdtContent();
        $pdt_content->product_id = $product->id;
        $pdt_content->content = $content;
        $pdt_content->save();
        return '<script>
            alert("添加成功");
//            var index = parent.layer.getFrameIndex(window.name);
//            parent.layer.close(index);
            parent.location.reload();
        </script>';
    }

    public function getEdit()
    {
        $product = Product::find($_GET['id']);
        $categorys = Category::where('status', 0)->get();
        return view('admin.product_edit')->with('product', $product)
            ->with('categorys', $categorys);
    }

    public function postEdit()
    {
        $name = $_POST['name'];
        $summary = $_POST['summary'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $preview = $_POST['preview'];
        $content = $_POST['content'];
        if ($name == '') {
            return '<script>alert("名字不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        if ($price == '') {
            return '<script>alert("价格不能为空");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        if ($preview == '') {
            return '<script>alert("请先上传图片");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        $product = Product::find($_POST['id']);
        $product->name = $name;
        $product->summary = $summary;
        $product->category_id = $category_id;
        $product->price = $price;
        $product->preview = $preview;
        $product->save();
        $pdt_content = PdtContent::where('product_id', $product->id)->first();
        $pdt_content->content = $content;
        $pdt_content->save();
        return '<script>
            alert("修改成功");
//            var index = parent.layer.getFrameIndex(window.name);
//            parent.layer.close(index);
            parent.location.reload();
        </script>';
    }
}