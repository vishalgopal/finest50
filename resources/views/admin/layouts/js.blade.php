<!-- Font Awesome JS -->

<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
{{-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script> --}}
<!-- jQuery CDN - Slim version (=without AJAX) -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<!-- Popper.JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> --}}
<!-- Bootstrap JS -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('js/sweet-alert.min.js')}}"></script>
<script src="{{asset('js/parsley.min.js')}}"></script>
<script>
    var baseurl=$('meta[name="baseurl"]').attr('content')+'/';</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<script>
    $(document).ready(function() {

            $('#table_id').DataTable({
            responsive: true,
            paging: true,
            "pageLength": 50
        });

    });
</script>
<div id="onpageload" class="center">
        <div  style="position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('{{asset('images/admin-loader.gif')}}') 50% 50% no-repeat rgba(249, 249, 249, 0);">
        </div>
</div>
<div id="myDivloader" style="display:none;position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('{{asset('images/admin-loader.gif')}}') 50% 50% no-repeat rgba(249, 249, 249, 0);">
</div>
<script>
    $(function () {
	var $loading = $('#myDivloader').hide();
	$(document)
		.ajaxStart(function () {
			$loading.show();
		})
		.ajaxStop(function () {
			$loading.hide();
		});
});
</script>
<script> 
    document.onreadystatechange = function() { 
        if (document.readyState !== "complete") { 
            document.querySelector( 
              "#onpageload").style.visibility = "visible"; 
        } else { 
            document.querySelector( 
              "#onpageload").style.display = "none"; 
        } 
    }; 
</script> 