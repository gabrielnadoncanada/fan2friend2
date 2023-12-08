<div class="">
    @include('sections.hero',[
        'title' => __('app.home.hero.title'),
        'description' => __('app.home.hero.description'),
        'buttonLink' => route('celebrity.index'),
        'buttonText' => __('app.home.hero.button_text'),
        'imageUrl' => 'https://images.unsplash.com/photo-1498758536662-35b82cd15e29?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80'
    ])
    @include('sections.latest-celebrities', ['latestCelebrities' => $latestCelebrities])
{{--    @include('sections.featured-celebrities', ['featuredCelebrities' => $featuredCelebrities])--}}
    @include('sections.celebrity-categories', ['categories' => $categories])
    @include('sections.how-it-work')
    @include('sections.call-to-action')
    @include('sections.partners')
    @include('sections.footer')
</div>
