<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    <title>Forcasting</title>
  </head>
  <body>
    <main>
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="content py-5">
              <div class="create-data mb-3">
                <form action="{{ route('forcasting.store') }}" method="post">
                  @csrf
                  <div class="form-row">
                    <div class="col">
                      <input type="number" class="form-control" placeholder="Aktual" name="harga">
                    </div>
                    <div class="col">
                      <input type="number" class="form-control" placeholder="Periode" name="periode">
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Periode</th>
                    <th scope="col">Aktual</th>
                    <th scope="col">S1</th>
                    <th scope="col">S2</th>
                    <th scope="col">a</th>
                    <th scope="col">b</th>
                    <th scope="col">f</th>
                    <th scope="col">xt_ft</th>
                    <th scope="col">pe</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($forcastings as $forcasting)
                  <tr>
                    <td>{{ $forcasting->periode }}</td>
                    <td>{{ $forcasting->aktual }}</td>
                    <td>{{ $forcasting->s1 }}</td>
                    <td>{{ $forcasting->s2 }}</td>
                    <td>{{ $forcasting->a }}</td>
                    <td>{{ $forcasting->b }}</td>
                    <td>{{ $forcasting->f }}</td>
                    <td>{{ $forcasting->xt_ft }}</td>
                    <td>{{ $forcasting->pe }}</td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
              @if (session('message'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif
              <div class="action d-flex">
                <form action="{{ route('forcasting.hitung') }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-primary">Hitung</button>
                </form>
                <form action="{{ route('forcasting.ramal') }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-success ml-2">Ramal</button>
                </form>
                <form action="{{ route('forcasting.reset') }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-danger ml-2">Reset</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    {{-- <script>
      $('#dpRM').datetimepicker({
    viewMode : 'months',
    format : 'MM/YYYY',
    toolbarPlacement: "top",
    allowInputToggle: true,
    icons: {
        time: 'fa fa-time',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});

$("#dpRM").on("dp.show", function(e) {
   $(e.target).data("DateTimePicker").viewMode("months"); 
});
    </script> --}}

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>