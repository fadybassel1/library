@extends('layouts.app')

@section('content')
    <style>


    </style>
    @if (Session::has('status'))
        <div class="container alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>
    @endif
    @if ($tagname ?? '' != null)
        <div class="text-center">
            <div style="font-size: 20px; margin-right: 15px;" class="badge badge-light">{{ $tagname }}</div>
        </div>
        <br>
    @endif

    <form action="{{ url('/bookSearch') }}"method="get">
        @csrf

        <div style="" class="card align-items-center">
            <div class="card-body" style="width: 50%">
                <div class="row m-2">
                    <div class="col-12">
                        <input class="form-control" value="{{ request()->input('qq') }}" id="qq" name="qq"
                            autocomplete="on" type="text" placeholder="Search" aria-label="Search">
                        <div id="selectTags">
                            <select name="tags[]" style="margin-left: -2px;" class="selectpicker show-menu-arrow"
                                data-style="form-control" data-live-search="true" title="Search" multiple="multiple">

                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" data-tokens="{{ $tag->id }}">
                                        {{ $tag->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row m-2 align-items-center">
                    <div class="col-9">
                        <select style="background-color: #363936; color:white" name="search" id="search"
                            class="form-control">
                            <option {{ request()->input('search') == 'book_name' ? 'selected' : '' }} value="book_name">اسم
                                الكتاب</option>
                            <option {{ request()->input('search') == 'book_description' ? 'selected' : '' }}
                                value="book_description">محتوى</option>
                            <option {{ request()->input('search') == 'book_author' ? 'selected' : '' }} value="book_author">
                                مؤلف</option>
                            <option {{ request()->input('search') == 'book_position' ? 'selected' : '' }}
                                value="book_position">رف</option>
                            <option {{ request()->input('search') == 'tags' ? 'selected' : '' }} value="tags">Tags
                            </option>
                            <!-- <option value="all">الجميع</option> -->
                            <!-- <option disabled>──────────</option> -->
                            <!-- <option disabled value="genre">تصنيف</option>
                            <option value="">— كتاب</option>
                            <option>— مجلة</option>
                            <option>— موسوعة</option> -->
                        </select>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-elegant" style="color: white" type="button" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">تصفية</button>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="card text-center">
                        <div id="collapseExample" class="card-body {{ isset($filter) && $filter ? '' : 'collapse' }} text-right">
                            <div class="row" style="direction: rtl">
                                <div class="col-3"><input value="{{ request()->input('edited_from') }}"
                                        placeholder="تاريخ التعديل من" class="form-control" type="date"
                                        name="edited_from" id="edited_from"></div>
                                <div class="col-3"><input value="{{ request()->input('edited_to') }}"
                                        placeholder="تاريخ التعديل الى" class="form-control" type="date" name="edited_to"
                                        id="edited_to"></div>
                                <div class="col-3"><input value="{{ request()->input('created_from') }}"
                                                placeholder="تاريخ الاضافة من" class="form-control" type="date"
                                                name="created_from" id="created_from"></div>
                                <div class="col-3"><input value="{{ request()->input('created_to') }}"
                                        placeholder="تاريخ الاضافة الى" class="form-control" type="date"
                                        name="created_to" id="created_to"></div>

                                <div class="col-6 mt-2">
                                    <select style="background-color: #363936; color:white" name="created_by" id="created_by"
                                        class="form-control">
                                        <option value="">تم الأضافة بواسطة</option>
                                        @foreach ($users as $user)
                                            <option {{ request()->input('created_by') == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mt-2">
                                    <select style="background-color: #363936; color:white" name="last_edited_by"
                                        id="last_edited_by" class="form-control">
                                        <option value="">تم اخر تعديل بواسطة</option>
                                        @foreach ($users as $user)
                                            <option {{ request()->input('last_edited_by') == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mt-2">
                                    <select style="background-color: #363936; color:white" name="sort_by"
                                        class="form-control">
                                        <option value="">ترتيب حسب </option>
                                        <option {{ request()->input('sort_by') == 'created_at' ? 'selected' : '' }}
                                            value="created_at">ترتيب حسب :تاريخ الاضافة </option>
                                        <option {{ request()->input('sort_by') == 'updated_at' ? 'selected' : '' }}
                                            value="updated_at">ترتيب حسب :تاريخ اخر تعديل</option>
                                        <option {{ request()->input('sort_by') == 'book_name' ? 'selected' : '' }}
                                            value="book_name">ترتيب حسب :اسم الكتاب</option>
                                    </select>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="form-check align-items-center">
                                        <input class="form-check-input" type="checkbox" name="sortDecending"
                                            id="sortDecending"
                                            {{ request()->input('sortDecending') == 'on' ? 'checked' : '' }}>
                                        <label class="form-check-label mr-4" for="sortDecending">     ترتيب تنازلى    </label>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <a type="button" href="{{route('books.index')}}">مسح التصفية</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-2 text-center">
                    <div class="col-12">
                        <input class="btn btn-elegant" style="color: white" type="submit" id="searchbtn"
                            value="بحث" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>




    <!-- <div  style="margin: 0 auto; text-align: center"  id="container">
          <iframe id="iframe" src="#toolbar=0" width="70%" height="600px;" ></iframe>
      </div> -->


    @if ($books ?? '' != null)
        <div style="text-align: center" class="alert alert-info">found total of {{ $books->total() }} results</div>
        <ul class="list-group list-group-flush text-right">
            @foreach ($books as $book)
                <li class="list-group-item">
                    <h5>
                        <span class="badge badge-info mr-2">تأليف: {{$book->book_author}}</span>
                        <span class="badge badge-primary mr-2">ترقيم: {{$book->book_position}}</span>
                        @if ($book['book_access'] == 0)
                            <span class="badge badge-danger">Restricted</span>
                        @endif <a
                            href="{{ route('books.show', $book) }}">{{ $book->book_name }}</a> 

                    </h5>
                    @if(isset($filter) && $filter)
             
                    <h5 style="direction:rtl "> 
                        <span class="badge badge-success mr-2">تاريخ الاضافة: {{!empty($book->created_at) ? $book->created_at->format("Y-m-d") : 'لا يوجد'}} </span> 
                        <span class="badge badge-success mr-2">اضافة: {{!empty($book->creator) ? $book->creator->name : 'لا يوجد'}}</span> 
                        <span class="badge badge-warning mr-2">تاريخ التعديل: {{!empty($book->updated_at) ? $book->updated_at->format("Y-m-d") : 'لا يوجد'}} </span> 
                        <span class="badge badge-warning mr-2">تعديل: {{!empty($book->lastUpdater) ? $book->lastUpdater->name : 'لا يوجد'}} </span> 
                    </h5>
         
                    @endif
                    <p>{{ $book['book_description'] }}</p>

                </li>
            @endforeach
        </ul>
        <div style="direction: RTL">
            {{ $books->appends(Request::all())->links() }}
        </div>
    @endif

    <script>
        $('#selectTags').hide();
        $('#search').on('change', function() {
            if (this.value == 'tags') {
                $('#qq').hide();
                $('#selectTags').show();
            } else {
                $('#qq').show();
                $('#selectTags').hide();
            }
        });
    </script>
@endsection
