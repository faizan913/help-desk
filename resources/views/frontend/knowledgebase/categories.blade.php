    <div class="row margin-top-20">
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <div class="support-container">
                    <h2 class="support-heading">{{ trans('global.need_support') }}</h2>
                    {{ trans('global.contact_for_help') }}
                    <a href="{{ url('create') }}">{{ trans('global.contact_us') }}</a> {{ trans('global._help') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="fb-heading-small">
                {{ trans('global.latest_article') }}
            </div>
            <hr class="style-three">
            <div class="fat-content-small padding-left-10">
                <ul>
                    @foreach ($latest_articles as $data)
                        <li>
                            <a href="{{ url('knowledge/detail', $data->id) }}">
                                <i class="fa fa-file-text-o"></i>
                                {{ Str::limit(strip_tags($data->question), 30, $end = '.') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
