@extends('layouts.default')

@section('content')
    <div class="row align-items-center h-100">
        <div class="col-12 col-sm-10 col-md-8 mx-auto">
            <div class="jumbotron text-center">
                <h1><i class="fa fa-search mr-2"></i> Word Search</h1>

                <form action="/" id="search">
                    <div class="input-group input-group-lg mt-4 mx-auto">
                        <input type="text" name="query" class="form-control" placeholder="Enter a word to search"
                               aria-describedby="query-addon" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search mr-2 search-icon"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div id="results" class="d-none mt-5">
                    <h3 id="result-title" class="text-capitalize"></h3>
                    <div id="results-items"></div>
                </div>

                <div id="resultItemTemplate" class="d-none">
                    <div class="card card-body my-3">
                        <p>(<i>__PARTOFSPEECH__</i>) __DEFINITION__</p>
                        <blockquote class="blockquote text-muted">__EXAMPLE__</blockquote>
                    </div>
                </div>

                <p class="text-center mt-3">
                    <a href="{{ url('search/previous') }}">See what others are searching</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            /**
             * Manual search via input
             */
            $('#search').on('submit', function () {
                var data = $(this).serializeArray();

                $('#results').addClass('d-none');
                $('#results-items').html('');
                $('.search-icon').removeClass('fa-search').addClass('fa-spinner fa-spin');

                $.post('/api/search', data, function (response) {
                    renderResults(response);

                }).fail(function () {
                    $('#result-title').html(data[0].value);
                    $('#results-items').html('<h2 class="text-danger">Definition not found</h2>');

                }).always(function () {
                    $('#results').removeClass('d-none');
                    $('.search-icon').removeClass('fa-spinner fa-spin').addClass('fa-search');
                });

                return false;
            });

            /**
             * Auto search by query string
             */
            var query = '{{ $query }}';

            if (query) {
                $('input[name="query"]').val(query);
                $('#search').submit();
            }


            /**
             * Displays the current search result
             * @param result
             */
            function renderResults(result) {
                var template = $('#resultItemTemplate').html();

                $('#result-title').html(result.word);
                $('#results-items').html('');

                $.each(result.results, function (i, def) {
                    var html = template;
                    html = html.replace(/__PARTOFSPEECH__/g, def.partOfSpeech);
                    html = html.replace(/__DEFINITION__/g, def.definition);
                    html = html.replace(/__EXAMPLE__/g, ('examples' in def) ? "<i>&quot;" + def.examples[0] + "&quot;</i>" : '<span class="text-danger">(Example not available)</span>');
                    $('#results-items').append(html);
                });
            }
        });
    </script>
@endsection
