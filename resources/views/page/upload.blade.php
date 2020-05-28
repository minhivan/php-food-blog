@extends('master')
@section('content')

<!-- Divide -->
<div class="divided"></div>
<!-- // End divide -->
<div class="tag-divide">
    <div class="container">
        <div class="container__tag_recipe">
            <h2 class="error-page__headline tag-title">CREATE YOUR OWN RECIPE</h2>
        </div>
    </div>
</div>

<div class="add-recipe">
    <div class="add-recipe__wrapper container">
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
                    <input type="text" name="title" id="" class="form-control" placeholder="Recipe Title" required>
                </div>
                <div class="descData input-field">
                    <textarea class="form-control" placeholder="Recipe Description" name="description"></textarea>
                </div>
            </fieldset>
            <fieldset class="recipe-categories">
                <h2>COLLECTION</h2>
                <div class="new-category input-field">
                    <select class="form-control" multiple="multiple" name="tag[]" required>
                        @foreach($tag as $t)
                            <option value="{{$t->id}}">{{$t->title}}</option>
                        @endforeach
                    </select>
                </div>

            </fieldset>
            <fieldset class="recipe-categories">
                <h2>Categories</h2>
                <div class="new-category input-field">
                    <select name="category" id="category" required>
                        @foreach($cat as $c)
                            <option value="{{$c->id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                </div>

            </fieldset>

            <fieldset class="recipe-more-details">
                <div class="new-category input-field">
                    <div id="drop-area">
                        <input type="file" id="fileElem" name="image[]" accept="image/*" multiple="multiple" onchange="handleFiles(this.files)" required>
                        <label class="button" for="fileElem">Choose Image</label>
                        <progress id="progress-bar" max=100 value=0></progress>
                        <div id="gallery"></div>
                    </div>
                    <div class="recipe-amount">
                        <div id="cookData">
                            <label class="cook-time-label">Cook Time:</label>
                            <div class="cook-time">
                                <input type="number" class="form-control number" placeholder="    ---" id="cookTime" name="cookTime" required>
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
                                <input type="number" class="form-control number" placeholder="    ---" id="serveTime" name="serveFor" required>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="recipe-steps">
                <h2>INGREDIENTS</h2>
                <p>Enter your ingredients one at a time or paste them into the box below and hit enter.</p>
                <div class="descData input-field">
                    <div class="insert" id="insert"></div>
                    <textarea class="form-control" placeholder="Recipe Ingredients" name="ingredients" id="insert_ingre"></textarea>
                    <textarea class="form-control hidden" name="ingredients_hiden" id="hid" ></textarea>
                    <textarea class="form-control hidden" name="ingredients_hiden1" id="hid1" ></textarea>
                </div>
            </fieldset>
            <fieldset class="recipe-steps">
                <h2>DIRECTIONS</h2>
                <p>Enter your directions one step at a time or paste them into the box below and hit enter. Don’t worry, we will number them for you.</p>
                <div class="descData input-field">
                    <textarea class="form-control" placeholder="Recipe Description" name="direction" required></textarea>
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
                    <button id="submitRecipe" value="Save" class="button" type="submit"><i></i><span>Save</span></button>
                    or <button id="cancelRecipe" class="button" type="reset">Cancel</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script src="source/assets/js/uploadImage.js"></script>
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
