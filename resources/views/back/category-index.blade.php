<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/6
 * Time: 9:31
 */

?>

@foreach ($categories as $category)
    <p>This is {{$category->id}}</p>
@endforeach


@forelse($categories as $category)
    <tr>
        <td>{{$loop->iteration}}.</td>
        <td>{{$category->title}}</td>
        <td>0</td>
        <td>{{$category->sort}}</td>
        <td>
            <a href="" class="btn btn-default" title="编辑"><span class="fa fa-edit"></span> 编辑</a>
            <a href="" class="btn btn-default" title="删除" onclick="return confirm('是否删除？');"><span class="fa fa-trash-o"></span> 删除</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">
            没有记录
        </td>
    </tr>
@endforelse

