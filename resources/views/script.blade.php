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

  <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/default.min.css">

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
      @foreach($codes['flist'] as $code)
      <li class="nav-item active">
        <a class="nav-link" href="#" onclick="outputFile('{{ $code }}');">
          <i class="fas fa-fw fa-cube"></i>
          <span>{{ $code }}</span>
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
        <pre>
            <code id="codeblocks">
              <!-- your code here -->

            </code>
        </pre>

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

  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
  <script src="//cdn.jsdelivr.net/gh/TRSasasusu/highlightjs-highlight-lines.js@1.1.5/highlightjs-highlight-lines.min.js"></script>

  <script>
    hljs.initHighlightingOnLoad();

    function outputFile(linecode){
      var temp = funList(linecode);
      temp = temp[0].replace("(","").replace(")","").split(":");
      
      $.get('/find/'+{{ $id }}+'/'+temp[0], function(response) {
          $("#codeblocks").html(response);
          $("#mainfile").html(temp[0]);
          
          hljs.initHighlightLinesOnLoad([
              [{start: temp[1]-1, end: temp[1]-1, color: '#999'}], // Highlight line code
          ]);          
        });
    }

    function funList(text) {
      var reglist = text.match(/\(.*?\)/g);
      reglist = reglist.filter(s=>~s.indexOf(":"));
      return reglist.reduce(function(a,b){
              if (a.indexOf(b) < 0 ) a.push(b);
              return a;
            },[]);
    }
  </script>
</body>

</html>