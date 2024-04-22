@if ($subcategory->subcategories)
@foreach ($subcategory->subcategories as $subcategory)
 <tr>
     <td  align="center">{{ str('-')->repeat($loop->depth) }}</td>
     <td><img width="80px" src="{{$subcategory->icon ? asset('storage/'.$subcategory->icon) : '' }}"  alt="{{ $subcategory->category }}">{{ $subcategory->category }}</td><td>{{ $subcategory->category_slug }}</td>
     <td>
        <div class="btn btn-group">
            <a href="{{ route('edit',$subcategory->id) }}" class="btn btn-primary btn-sm">edit</a>
            <a href="{{ route('delete', $subcategory->id) }}" class="btn btn-danger btn-sm">delete</a>
   </div>
     </td>
 </tr>
 @include('layouts.components.CategoryComponent')
@endforeach
@endif
