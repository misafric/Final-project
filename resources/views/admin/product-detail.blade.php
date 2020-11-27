<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        body {background-color:#666633; margin: 1rem}
        table,th,tr,td {border: 0.25rem solid black; border-collapse: collapse}
        td {padding: 0.5rem}
    </style>

    <title>Admin Product Management</title>
</head>
<body>
    <section class='product-detail'>
        <h2><u>Product Management</u></h2>

        <form action="/api/cart/add" method="post" id="order_form">
            @csrf
            <input type="hidden" name="order_unit_price" value="{{$product["unit_price"]}}">
        </form>
        
        <b style="color:#800000; font-size: 1.25rem">Name</b>: <input type="text" value='{{$product["name"]}}'><br>
        <b style="color:#800000; font-size: 1.25rem">Price</b>: <input type="text" value='{{$product["unit_price"]}}'><br>
        <div style="display:flex;">
            <div style="margin: 1rem 1rem 1rem 0rem">
                <b style="color:#800000; font-size: 1.25rem">Short description</b>: <br>
                <textarea name="" id="" cols="30" rows="4">{{$product["description_short"]}}</textarea>
            </div>
            <div style="margin: 1rem">
                <b style="color:#800000; font-size: 1.25rem">Long description</b>: <br>
                <textarea name="" id="" cols="80" rows="4">{{$product["description_long"]}}</textarea>
            </div>
        </div>
        
        <div style="display:flex;">
            @foreach ($product_tag_categories as $product_tag_category)
                <div style="min-width: 10vw">
                {{-- @if ($product_tag->tag_category->is_visible == 1) --}}
                    <b><label for="">{{$product_tag_category->name}}:</label></b>
                    <br>
                    @foreach ($product_tag_category->tags as $tag)
                        <input type="checkbox" value="{{$tag->id}}" {{$tag->checked}}> {{$tag->name}} <br>
                    @endforeach
                {{-- @endif --}}
                </div>
            @endforeach
        </div>

        <hr>

        <h3><u>Articles Management</u></h3>
    
        <table>
            {{-- <th> --}}
                <tr>
                    <td><b style="color:#800000; font-size: 1.25rem">Article</b></td>
                    <td><b style="color:#800000; font-size: 1.25rem">Article ID</b></td>
                    @foreach ($article_tag_categories as $article_tag_category)
                            <td><b>{{$article_tag_category->name}}</b></td>
                    @endforeach
                </tr>
            {{-- </th> --}}
    
                @foreach ($articles as $i=>$article)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$article->id}}</td>
                        @foreach ($article_tag_categories as $article_tag_category)
                            <td>
                                {{-- @foreach ($article_tag_category->tags as $tag) --}}
                                    @if ($article_tag_category->is_identifier == 1)
                                    <input name="{{$article_tag_category->id.'-'.$article->id}}" type="radio" value="0">
                                    N/A <br>
                                        @foreach ($article_tag_category->tags as $tag)
                                            <input name="{{$article_tag_category->id.'-'.$article->id}}" type="radio" value="{{$tag->id}}" {{in_array($tag->id, $article->tag_array) ? 'checked' : ''}}>
                                            {{$tag->name}}
                                            <br>
                                        @endforeach        
                                    @else
                                    @foreach ($article_tag_category->tags as $tag)
                                        <input name="{{$article_tag_category->id.'-'.$article->id}}" type="checkbox" value="{{$tag->id}}" {{in_array($tag->id, $article->tag_array) ? 'checked' : ''}}>
                                        {{$tag->name}}
                                        <br>
                                    @endforeach
                                    @endif
                                    
                                    
                                    
                                
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            
        </table>
    
        <div id="app"></div>
    
        @if (session('status'))
        <div id="success-message">
            {{ session('status') }}
        </div>
        @endif
    
    </section>    
</body>
</html>