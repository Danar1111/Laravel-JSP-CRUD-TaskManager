<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .tb_tanggal {
            width: 100%;
            border-collapse: collapse;
        }
        .tb_tanggal td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }
        .highlight {
            background-color: rgb(0, 217, 255);
        }
    </style>
</head>
<body class="bg-light">
    <div class="text-center mt-4" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        <h1>Task Manager</h1>
    </div>
    <header class="mx-5 d-flex container-l my-md-3 bd-layout text-center">
        <div class="w-100 my-3 p-3 bg-body rounded shadow-sm">
            <div id="quote" class="fs-5"></div>
        </div>
    </header>
    @if (Session::has('success'))
        <div class="mx-5 my-0 alert alert-success text-center">
            {{ Session::get('success') }}
        </div>
    @endif
    <main class="mx-5 d-flex container-l my-md-1 bd-layout">
        <!-- START DATA -->
        <div class="w-75 my-1 p-3 bg-body rounded shadow-sm">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">Tittle</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-2">Category</th>
                            <th class="col-md-1">Due Date</th>
                            <th class="col-md-1">Priority</th>
                            <th class="col-md-1">Done at</th>
                            <th class="col-md-1 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr class="{{ \Carbon\Carbon::parse($item->due_date)->isPast() ? 'bg-warning' : '' }}">
                            <td>{{ $i }}</td>
                            <td>{{ $item->title }}</td>   
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->due_date)->diffForHumans() }}</td>
                            <td>{{ $item->priority }}</td>
                            <td>{{ $item->done_at }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('are you sure you want to delete the history task?')" class="d-inline" action="{{ url('history/'.$item->title) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm w-auto">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->withQueryString()->links() }}
        </div>
        <aside class="w-25 mx-auto ">
            <div class="m-1 y-3 p-3 bg-body rounded shadow-sm">
                @auth
                    <h2 class="p-2 mb-4">History of, {{ Auth::user()->name }}</h2>
                @endauth
                <table class="table-bordered tb_tanggal">
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>

                <!-- FORM PENCARIAN -->
                <div class="pb-2 pt-4">
                    <form class="d-flex" action="{{ url('/history') }}" method="get" autocomplete="off">
                        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Find Something" aria-label="Search">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </form>
                </div>

                <h3 class="pt-2">Priority</h3>
                <form class="pb-2 pt-2 d-flex" action="{{ url('/history') }}" method="get">
                    <div class="form-check m-2">
                        <input class="form-check-input" type="radio" name="pr" id="redRadio" value="urgent">
                        <label class="form-check-label" for="redRadio">
                            Urgent
                        </label>
                    </div>
                    
                    <div class="form-check m-2">
                        <input class="form-check-input" type="radio" name="pr" id="blueRadio" value="finish_him">
                        <label class="form-check-label" for="blueRadio">
                            Finish Him
                        </label>
                    </div>
                    
                    <div class="form-check m-2">
                        <input class="form-check-input" type="radio" name="pr" id="greenRadio" value="chill">
                        <label class="form-check-label" for="greenRadio">
                            Chill
                        </label>
                    </div>
                    <button class="btn btn-success px-3 mx-3" type="submit" >Sort</button>
                </form>

                <div class="pb-2 pt-5 position-relative">
                    <a href='../' class="btn btn-danger position-absolute bottom-0 end-0">back</a>
                </div>
            </div>
        </aside>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>