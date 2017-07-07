<div class="panel panel-default">
    <div class="panel-heading">Scheduled Tweets</div>

    <div class="panel-body">
        @if(isset($scheduledTweets) && count($scheduledTweets))
            @foreach($scheduledTweets as $tweet)
            <div class="row m0">
                
                <div class="card tweet">
                    <div class="card-block">
                        <div class="pull-left">
                            <img class="display-picture" src="{{$profile->image_url}}" alt="">
                        </div>
                        <span class="screen_name"><a href="{{'https://twitter.com/'.$profile->screen_name}}">@ {{$profile->screen_name}}</a></span>
                                                                
                        <p>{{$tweet->text}}</p>
                        <a href="{{url('/tweets')}}/{{$tweet->id}}" class="btn btn-primary pull-right"> <i class="fa fa-edit"></i> Edit</a>

                        <a href="{{url('/tweets')}}/{{$tweet->id}}/remove" class="btn btn-danger pull-right"> <i class="fa fa-trash"></i> Delete</a>    
                        
                    </div>
                </div>
                
            </div>
            @endforeach
        @else
            Nothing scheduled yet
        @endif 
    </div>
</div>    