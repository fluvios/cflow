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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/default.min.css">

</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Fun CAG</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <span>Export Files</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Files
      </div>

      <!-- Nav COG Item -->
      @foreach($files as $file)
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <span>{{ $file['name'] }}</span>
        </a>
      </li>
      @endforeach

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

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
                    <td>Language: </td>
                    <td>{{ $csv[0]['language'] }}</td>
                  </tr>
                  <tr>
                    <td>Files: </td>
                    <td>{{ $csv[0]['files'] }}</td>
                  </tr>
                  <tr>
                    <td>Blank: </td>
                    <td>{{ $csv[0]['blank'] }}</td>
                  </tr>
                  <tr>
                    <td>Comment: </td>
                    <td>{{ $csv[0]['comment'] }}</td>
                  </tr>
                  <tr>
                    <td>Code: </td>
                    <td>{{ $csv[0]['code'] }}</td>
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

<!-- Modal -->
<div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Code Snippet-->
        <pre>
            <code id="codejam">
            <!-- your code here -->

            </code>
        </pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
  <script src="//cdn.jsdelivr.net/gh/TRSasasusu/highlightjs-highlight-lines.js@1.1.5/highlightjs-highlight-lines.min.js"></script>

  <script>
    hljs.initHighlightingOnLoad();

    function outputFile(id, filename){
        document.getElementById("mainfile").innerHTML = filename;

        $.get('/filelist/'+id+'/'+filename, function(response) {
            var textcontent = response;
            var reglist = funList(response);
            for(x in reglist) {
              var link = "<a data-toggle='modal' class='openDialog' data-id='"
                          +reglist[x]+"' data-target='#codeModal'><font color='FF00CC'>"
                          +reglist[x]+"</font></a>";
              textcontent = textcontent.replace(reglist[x], 
                link);
              $("#codeblocks").html(textcontent);
            }
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

    $(document).on("click", ".openDialog", function () {
        var temp = $(this).data('id');
        temp = temp.replace("(","").replace(")","").split(":");        
        // temp = temp.replace(")","");        
        // temp = temp.split(":");

        $.get('/find/'+{{ $id }}+'/'+temp[0], function(response) {
          $("#exampleModalLongTitle").html(temp[0]);
          $("#codejam").html(response);

          hljs.initHighlightLinesOnLoad([
              [{start: temp[1]-1, end: temp[1]-1, color: '#999'}], // Highlight line code
          ]);          
        });
    })
  </script>
</body>

</html>