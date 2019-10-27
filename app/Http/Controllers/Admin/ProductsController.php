<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ProductsDatatable;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Size;
use App\Model\Weight;
use App\Model\OtherDate;
use App\Model\MallProduct;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDatatable $product)
    {
        //
        return $product->render('admin.products.index',['title'=>'Product Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Product = Product::create(['title'=>'']);
        if(!empty($Product))
        {
            return redirect(aurl('products/'.$Product->id.'/edit'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       /* $data =$this->validate(request(),[
            'name'=>'required',
             ],[],[
            'name'=>'Name',
            ]);
        Product::create($data);
        session()->flash('success','Product Added');
        return redirect(aurl('products'));*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Product=Product::find($id);
        $title=!empty($Product)?'Edit '.$Product->title:"Add Or Delete Product";
        return view('admin.products.product',['title'=>$title,'Product'=>$Product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data =$this->validate(request(),[
            'title'         =>'required',
            'content'       =>'required',
            'department_id' =>'sometimes|nullable|numeric',//'required|numeric',
            'trad_id'       =>'sometimes|nullable|numeric',//'required|numeric',
            'mani_id'       =>'sometimes|nullable|numeric',//'required|numeric',
            'color_id'      =>'sometimes|nullable|numeric',
            'currency_id'   =>'sometimes|nullable|numeric',
            'size'          =>'sometimes|nullable',
            'size_id'       =>'sometimes|nullable|numeric',
            'price'         =>'sometimes|nullable|numeric',//'required|numeric',
            'stock'         =>'sometimes|nullable|numeric',//'required|numeric',
            'start_at'      =>'sometimes|nullable|date',//'required|date',
            'end_at'        =>'sometimes|nullable|date',//'required|date',
            'start_offer_at'=>'sometimes|nullable|date',
            'end_offer_at'  =>'sometimes|nullable|date',
            'price_offer'   =>'sometimes|nullable|numeric',
            'weight'        =>'sometimes|nullable',
            'weight_id'     =>'sometimes|nullable|numeric',
            'status'        =>'sometimes|nullable|in:panding,refused,active',
            'reason'        =>'sometimes|nullable',
             ],[],[
                'title'         =>'title',         
                'content'       =>'content',       
                'department_id' =>'department',
                'trad_id'       =>'tradMark',
                'mani_id'       =>'mani',
                'color_id'      =>'color',
                'currency_id'   =>'currency',
                'size_id'       =>'size',
                'price'         =>'price',
                'stock'         =>'stock',
                'start_at'      =>'start at',
                'end_at'        =>'end at',
                'start_offer_at'=>'start offer at',
                'end_offer_at'  =>'end offer at',
                'price_offer'   =>'price offer',
                'weight'        =>'weight',
                'weight_id'     =>'weight id',
                'status'        =>'status',
                'reason'        =>'reason'  
            ]);
        if(request()->has('mall'))
        {
            MallProduct::where('product_id',$id)->delete();
            foreach (request('mall') as $mall ) {
                MallProduct::create([
                    'product_id' =>$id,
                    'mall_id'   =>$mall,
                ]);
            }
        }
        if(request()->has('input_value') and request()->has('input_key'))
        {
            $i=0;
            $other_data='';
            OtherDate::where('product_id',$id)->delete();
            foreach (request('input_key') as $key ) {
                $data_value =! empty(request('input_value')[$i])?request('input_value')[$i]:'';
                OtherDate::create([
                    'product_id' =>$id,
                    'data_key'   =>$key,
                    'data_value' =>$data_value,
                ]);
                $i++;
            }
            $data['other_data']=rtrim($other_data,'|');
        }
        Product::where('id',$id)->update($data);
        if(request()->ajax())
        {
           return response(['status'=>true,'message'=>'Product Updated'],200);
        }
        else
        {
            return redirect(aurl('products'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product=Product::find($id);
        $Product->delete();
        session()->flash('success','Product Delete');
        return redirect(aurl('products'));
    }
    public function muilt_all()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id) {
                $Product=Product::find($id);
                $Product->delete();
            }

             session()->flash('success','Product Delete');
        }
        else
        {
            $Product=Product::find(request('item'));
            $Product->delete();
            session()->flash('success','Products Delete');
        }
        return redirect(aurl('products'));
    }


    public function upload_file($id)
    {
        if(request()->hasfile('file'))
        {
            $fid= up()->upload([
                'file'=>'file',
                'path'=>'products'.$id,
                'upload_type'=>'files',
                'file_type'=>'product',
                'relation_id'=>$id,

            ]);
            return response(['status'=>true,'id'=>$fid],200);
        }
    }



    public function delete_file()
    {
        if(request()->has('id'))
        {
            return up()->delete(request('id'));
        }
    }




    public function upload_product_image($id)
    {
        $product = Product::where('id',$id)->update([
            'photo'=> up()->upload([
                'file'=>'file',
                'path'=>'products'.$id,
                'upload_type'=>'single',

            ]),
        ]);
            return response(['status'=>true],200);
    }




    public function delete_product_image($id)
    {
        $product = Product::find($id);
        \Storage::delete($product->photo);
        $product->photo=null;
        $product->save();
        return response(['status'=>true],200);
    }


     public function prepare_weights_size()
    {
       if(request()->ajax() and request()->has('dep_id'))
       {
        $dep_list=array_diff(explode(',',get_parent(request('dep_id'))), [request('dep_id')]);

        $sizes=Size::where('is_public','yes')
                    ->whereIn('department_id',$dep_list)
                    ->orWhere('department_id',request('dep_id'))
                    ->pluck('name','id');

        $weight=Weight::pluck('name','id');
        return view('admin.products.ajax.size_weight',[
            "size"=>$sizes,
            "weight"=>$weight,
            "product"=>Product::find(request('product_id'))
        ])->render();
       }else
       {
        return "//////////";
       }
    }


}
