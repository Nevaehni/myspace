
// $('#searchBar').keyup(function(){ 
//     var query = $(this).val();
//     if(query != '')
//     {
//      var _token = $('input[name="_token"]').val();
//      $.ajax({
//       url:"{{ route('autocomplete.fetch') }}",
//       method:"POST",
//       data:{query:query, _token:_token},
//       success:function(data){
//        $('#searchResults').fadeIn();  
//                 $('#searchResults').html(data);
//       }
//      });
//     }
// });

// $(document).on('click', 'li', function(){  
//     $('#searchBar').val($(this).text());  
//     $('#searchResults').fadeOut();  
// });

// var path = "{{ route('autocomplete') }}";
// 	$('input.typeahead').typeahead({
// 		source:  function (query, process) {
// 		return $.get(path, { query: query }, function (data) {
// 				return process(data);
// 			});
// 		},
// 		autoSelect: true,
// 		fitToElement: true,
// 		updater: function (item) {
// 			/* navigate to the selected item */
// 			window.location.href = "{{ url('bedrijven') }}/"+item["slug"];
// 		},
        
// 	});