<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Fun CaG</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{ url('/') }}">Fun CaG</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="navbar-brand mr-1" href="{{ url('/filelist/'.$id) }}">Files</a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="navbar-brand mr-1" href="{{ url('/analyze/'.$id) }}">Analyze</a>
      </li>
    </ul>
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      @foreach($files as $file)
      <li class="nav-item active">
        <a class="nav-link" href="#" onclick="outputFile('{{$id}}','{{$file['name']}}');">
          <i class="fas fa-fw fa-file"></i>
          <span>{{ $file['name'] }}</span>
        </a>
      </li>
      @endforeach
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a id="mainfile" href="#"></a>
          </li>
        </ol>
      </div>
      <!-- /.container-fluid -->
    
      <div class="container-fluid">

        <!-- Code Snippet-->
        <xpm>
            <pre id="codeblocks">
            <!-- your code here -->

            </pre>
        </xpm>

        <!-- Program Statistic  -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Projects Statistics</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Source Files: </td>
                    <td>7</td>
                  </tr>
                  <tr>
                    <td>Directories: </td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>Lines of Code: </td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td>Average Lines of Code: </td>
                    <td>8</td>
                  </tr>
                  <tr>
                    <td>Comment Lines: </td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>Main Function: </td>
                    <td>Found</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

  <script>
    function outputFile(id, filename){
        document.getElementById("mainfile").innerHTML = filename;

        $.get('/filelist/'+id+'/'+filename, function(response) {
            $("#codeblocks").html(response);
        });
    }
  </script>
</body>

</html>