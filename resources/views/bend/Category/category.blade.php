@extends('layouts.bendLay')
@section('we')
<section style="margin-top: 12px;">
     <div class="container">
        <div class="row">
                {{-- form --}}
                  <div class="col-lg-4">
                   @if (Route::is('category'))
                   {{-- add category --}}
                   <div class="card">
                    <div class="card-heading" style="padding: 12px;">
                         <h4>add category</h4>
                    </div>
                    <div class="card-body">
                           <form action="{{ route('category') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input name="category" type="text" placeholder="category" class="form-control">
                              <select name="category_id" class="form-control my-3 col-lg-12" id="categoryId">
                                <option disabled selected>
                                    Select and parent category
                                </option>
                                @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                              @endforeach

                              </select>
                              <label>Category icon</label>
                              <input type="file" name="icon" class="form-control">
                              @error('icon')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror

                              <button type="submit" class="btn btn-primary w-100 my-3">
                                    Submit
                              </button>
                           </form>
                    </div>
              </div>
                   @else
                   {{-- edit category --}}
                   <div class="card">
                    <div class="card-heading" style="padding: 12px;">
                         <h4>edit category</h4>
                    </div>
                    <div class="card-body">
                           <form action="{{ route('update',$findCategory->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <input value="{{ $findCategory->category }}" name="category" type="text" placeholder="category" class="form-control">
                              <select name="category_id" id="categoryId" class="form-control">

                                @foreach ($categorys as $category)
                                @if ($findCategory->id != $category->id)
                                <option {{ $findCategory->category_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->category }}</option>

                                @endif
                              @endforeach
                              </select>
                              <label>Category icon</label>
                              <input type="file" name="icon" class="form-control">
                            <input type="hidden" name="old" value="{{ $findCategory->icon }}">
                              <button type="update" class="btn btn-primary w-100 my-3">
                                    update
                              </button>
                           </form>
                    </div>
              </div>

                   @endif

                  </div>
                {{-- table --}}
                <div class="col-lg-8">
                    <table class="table table-stripped" style="border:  3px solid #eee;">
                        <tr>
                            <td align="center">Sn</td>
                            <td>category</td>
                            <td>category-Slug</td>
                            <td></td>
                           </tr>



                           <tr>  @forelse ($parentCategories as $key=>$category)
                            <td align="center">{{ $categorys->firstItem()+$key }}</td>
                            <td><img width="80px" src="{{ asset('storage/'.$category->icon) }}"  alt="{{ $category->category }}">{{ $category->category }}</td>
                            <td>{{ $category->category_slug }}</td>
                            <td>
                                <div class="btn btn-group">
                                    <a href="{{ route('edit',$category->id) }}" class="btn btn-primary btn-sm">edit</a>
                                    <a href="{{ route('delete', $category->id) }}" class="btn btn-danger btn-sm">delete</a>
                           </div>
                            </td>
                           </tr>
                           @if ($category->subcategories)
                               @foreach ($category->subcategories as $subcategory)
                                <tr>
                                    <td align="center">{{ str('-')->repeat($loop->depth) }}</td>
                                    <td><img width="80px" src="{{ asset('storage/'.$subcategory->icon) }}"  alt="{{ $subcategory->category }}">{{ $subcategory->category }}</td><td>{{ $subcategory->category_slug }}</td>
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
                           @empty
                            <tr>
                                <td>no data found</td>
                            </tr>

                        @endforelse

                    </table>{{ $categorys->links() }}
                </div>
        </div>
     </div>
</section>
@endsection
