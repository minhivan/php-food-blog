@extends('admin.layout.index')

@section('content')
    <div class="food-content">
        <div class="breadcrumb">
            <a href="admin">Spicy Food</a> / <a href="admin/recipe/list">Recipe</a> / <span>Add new</span>
        </div>
        <h1>New recipe</h1>
        <div class="wrap add-recipe">
            <div class="add-recipe__wrapper">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        @foreach($errors->all() as $err)
                            <p>{{$err}}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        <strong>{{session('thongbao')}}</strong>
                    </div>
                @endif
                <form action="" method="post" class="form-add-recipe my-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <fieldset class="recipe-title">
                        <div class="title-data input-field">
                            <input type="text" name="title" id="" class="form-control" value="{{$data->title}}"></input>
                        </div>
                        <div class="descData input-field">
                            <textarea class="form-control" placeholder="Recipe Description" name="description">{{$data->description}}</textarea>
                        </div>
                    </fieldset>
                    <fieldset class="recipe-categories">
                        <h2>Categories</h2>
                        <div class="new-category input-field">
                            <select name="category" id="category">
                                @foreach($cat as $c)
                                    @if($c->id==$data->cat_id)
                                        <option value="{{$c->id}}" selected>{{$c->title}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->title}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>

                    </fieldset>
                    <fieldset class="recipe-categories">
                        <h2>Tag</h2>
                        <div class="new-category input-field">
                            <select class="form-control" multiple="multiple" name="tag[]">
                                @foreach($tag as $t)
                                    @foreach($recipe_tag as $k)
                                        @if($k->id_tag==$t->id)
                                            <option value="{{$t->id}}" selected>{{$t->title}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                    </fieldset>
                    <fieldset class="recipe-more-details">
                        <h2>Recipe image</h2>
                        <div id="gallery1">
                            @if($data->img_thumb!= null)
                                @php
                                    $str = $data->img_thumb;
                                    $myArray = explode(';', $str);
                                    foreach ($myArray as $img){
                                        echo '<img src="upload/image/'.$img.'"/>';
                                    }
                                @endphp
                            @endif
                        </div>
                        <div class="new-category input-field">
                            <div id="drop-area">
                                <input type="file" id="fileElem" name="image[]" accept="image/*" multiple="multiple" onchange="handleFiles(this.files)" >
                                <label class="button" for="fileElem">Upload new</label>
                                <progress id="progress-bar" max=100 value=0></progress>
                                <div id="gallery">
                                </div>
                            </div>

                            <div class="recipe-amount">
                                <div id="cookData">
                                    <label class="cook-time-label">Cook Time:</label>
                                    <div class="cook-time">
                                        <input type="number" class="form-control number" placeholder="    ---" id="cookTime" name="cookTime" value="{{$data->cook_time}}">
                                        <div class="cook-unit-select">
                                            <select name="cook_unit_select" id="cookTimeUnit">
                                                <option value="1">Minutes</option>
                                                <option value="2">Hour</option>
                                                <option value="3">Day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="serveData">
                                    <label class="serve-time-label">Serve</label>
                                    <div class="serve-time">
                                        <input type="number" class="form-control number" placeholder="    ---" id="serveTime" name="serveFor" value="{{$data->serve_for}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="recipe-steps">
                        <h2>INGREDIENTS</h2>
                        <p>Enter your ingredients one at a time or paste them into the box below and hit enter.</p>
                        <div class="descData input-field">

                            <textarea class="form-control" name="old_ingredients" id="old_ingre" readonly>{{$data->ingredients}}</textarea>
                            <div class="insert" id="insert">
                            </div>
                            <textarea class="form-control" placeholder="Recipe Ingredients" name="ingredients" id="insert_ingre"></textarea>
                            <textarea class="form-control hidden" name="ingredients_hiden" id="hid" ></textarea>
                            <textarea class="form-control hidden" name="ingredients_hiden1" id="hid1" ></textarea>
                        </div>
                    </fieldset>
                    <fieldset class="recipe-steps">
                        <h2>DIRECTIONS</h2>
                        <p>Enter your directions one step at a time or paste them into the box below and hit enter. Don’t worry, we will number them for you.</p>
                        <div class="descData input-field">
                            <textarea class="form-control" placeholder="Recipe Description" name="direction" >{{$data->step}}</textarea>
                        </div>
                    </fieldset>
                    <fieldset class="recipe-submit">
                        <h2>Save this recipe as</h2>
                        <div class="public-radio">
                            <input id="isPublicTrue" type="radio" name="rIsPublic" value="1" checked>
                            <label for="isPublicTrue">Public</label>
                        </div>
                        <div class="private-radio">
                            <input id="isPublicFalse" type="radio" name="rIsPublic" value="0">
                            <label for="isPublicFalse">Draft</label>
                        </div>
                        <p>When you click Save, additional changes cannot be made until your recipe is published.</p>
                        <div class="submitSection">
                            <button id="submitRecipe" value="Save" class="button" type="submit">Save</button>
                            or <button id="cancelRecipe" class="button" type="reset">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('select').select2({
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                }
            }
        });
    </script>
@endsection
