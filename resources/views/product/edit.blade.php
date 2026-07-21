@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control" placeholder="Наименование">
                    </div>

                    <div class="form-group">
                        <input type="text" name="description" value="{{ old('description', $product->description) }}" class="form-control" placeholder="Описание">
                    </div>

                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Контент">{{ old('content', $product->content) }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="Цена со скидкой">
                    </div>

                    <div class="form-group">
                        <input type="text" name="old_price" value="{{ old('old_price', $product->old_price) }}" class="form-control" placeholder="Цена">
                    </div>

                    <div class="form-group">
                        <input type="text" name="count" value="{{ old('count', $product->count) }}" class="form-control" placeholder="Количество на складе">
                    </div>

                    <div class="form-group">
                        @if($product->preview_image)
                            <img src="{{ Storage::url($product->preview_image) }}" style="max-height: 100px;" class="mb-2">
                        @endif

                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="category_id" class="form-control select2">
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" style="width:100%">
                            @foreach($tags as $tag)
                                <option
                                    value="{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $tag->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" style="width:100%">
                            @foreach($colors as $color)
                                <option
                                    value="{{ $color->id }}"
                                    {{ in_array($color->id, old('colors', $product->colors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $color->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
