@extends('layouts.frontend.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container featured-area-default padding-30">
                    <div class="row">
                        <div class="col-md-8 padding-20">
                            <div class="row">
                                <div class="fb-heading">
                                    {{ trans('global.knowledge_base') }}
                                </div>
                                <hr class="style-three">
                                <div class="row">
                                    @foreach ($knowledges as $data)
                                        <div class="col-md-6 margin-bottom-20">
                                            <div class="fat-heading-abb">
                                                <i class="fa fa-folder"></i> {{ $data->name }}
                                                <span class="cat-count">({{ count($data->knowledges) }})</span>
                                            </div>
                                            <div class="fat-content-small padding-left-30">
                                                @forelse ($data->knowledges as $question)
                                                    <ul>
                                                        <li>
                                                            <a href="{{ url('knowledge/detail', $question->id) }}">
                                                                <i class="fa fa-file-text-o"></i>
                                                                {{ Str::limit(strip_tags($question->question), 30, $end = '.') }}</a>
                                                        </li>
                                                    </ul>
                                                @empty
                                                    <p>{{ trans('global.no_article') }} </p>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- END ARTICLES CATEOGIRES SECTION -->
                            </div>
                        </div>
                        <div class="col-md-4 padding-20">

                            <div class="row margin-top-20">
                                @include('frontend.knowledgebase.categories')
                            </div>

                        </div>
                        <!-- END SIDEBAR STUFF -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
