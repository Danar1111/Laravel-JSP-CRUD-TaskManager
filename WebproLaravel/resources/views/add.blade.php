<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="bg-light">
    <div class="text-center mt-4 mb-4" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        <h1>Add Task</h1>
    </div>
    <main class="container">
        <!-- START FORM -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action='' method='post' autocomplete="off">
        @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='title' id="title" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='description' id="description">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='category' id="category">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-10">
                        <div class="input-group due_date" id="datepicker">
                            <input type="text" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="priority" class="col-sm-2 col-form-label">Priority</label>
                    <div class="col-sm-10">
                        <select class="form-select" name='priority' id="priority">
                            <option value="urgent">Urgent</option>
                            <option value="finish_him">Finish Him</option>
                            <option value="chill">Chill</option>
                        </select>
                    </div>
                </div>                
                <div class="mb-3 row">
                    <label for="add" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
                </div>
                <div class="pb-2 pt-5 position-relative">
                    <a href='home' class="btn btn-secondary position-absolute bottom-0 end-0">Back</a>
                </div>
        </form>
    </main>
    <div class="container position-absolute bottom-0 start-50 translate-middle-x mb-5 pb-5">
        <div class="text-center">
            <h1>Today</h1>
        </div>
        <div class="date-container text-center"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>