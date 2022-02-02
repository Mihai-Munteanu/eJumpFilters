<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Filters</title>

    </head>
    <body style="margin-left: 20px; margin-top:20px">
        <form method="GET" action="#" id="filterFormId">

            <label for="filterA">A:</label>
                <select
                    onchange="filterSelected('filterA');"
                    name="filterA"
                    id="filterA"
                    class="width:60px;"
                    style="border:solid 1px black; border-radius:4px; margin-bottom:10px">

                    <option value="{{ NULL }}">Toate</option>

                    @foreach ($filterA as $item)
                        <option value="{{ $item }}"
                            {{ request('filterA') == $item ? "selected='selected'" : ''}}
                            {{ count($filterA) == 1 ? "selected='selected'" : '' }}
                            >
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            </br>

            <label for="filterB">B:</label>
                <select
                    onchange="filterSelected('filterB');"
                    name="filterB"
                    id="filterB"
                    class=" width:60px;  filterB-filter"
                    style="border:solid 1px black; border-radius:4px; margin-bottom:10px;">

                    <option value="{{ NULL }}">Toate</option>

                    @foreach ($filterB as $item)
                       <option value="{{ $item }}"
                            {{ request('filterB') == $item ? "selected='selected'" : ''}}
                            {{ count($filterB) == 1 ? "selected='selected'" : '' }}
                            >
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            </br>

            <label for="filterC">C:</label>
                <select
                    onchange="filterSelected('filterC');"
                    name="filterC"
                    id="filterC"
                    class=" width:60px;  filterC-filter"
                    style="border:solid 1px black; border-radius:4px; margin-bottom:10px">

                    <option value="{{ NULL }}">Toate</option>

                    @foreach ($filterC as $item)
                       <option value="{{ $item }}"
                            {{ request('filterC') == $item ? "selected='selected'" : ''}}
                            {{ count($filterC) == 1 ? "selected='selected'" : '' }}
                            >
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @foreach ($newListItems as $items)
            @foreach ($items as $item)
                {{ $item }},
            @endforeach
            </br>
        @endforeach
    </body>
    <script>
        function filterSelected(name) {
            // submit Form
            document.getElementById('filterFormId').submit()
        }
    </script>

</html>


