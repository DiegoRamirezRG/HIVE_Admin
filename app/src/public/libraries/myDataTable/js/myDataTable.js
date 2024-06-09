var arregloDataTable = new Object();

function ajaxMyDatatable(data) {
	if (data.table.length == 0) {
		console.log("MyDataTable Error: The table does not exist.");
		return;
	}

	if (data.table.children('thead').children('tr').children('th').length != data.colums.length) {
		console.log("MyDataTable Error: The number of columns does not match the given array.");
		return;
	}

	Object.assign(arregloDataTable, { [data.table.attr('id')]: data });

	if (data.table.children('thead').children('tr').children('th.sorting').length == 0) {
		if (data.sort != undefined) {
			data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').children('i').removeClass('bx-sort-alt-2');
			data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').addClass('sorting');
			data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').children('i').css('color', '#007AC4');

			if (data.sort[1] == "asc") {
				data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').children('i').addClass('bx-sort-up');
				data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').addClass('sorting_asc');
			} else if (data.sort[1] == "desc") {
				data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').children('i').addClass('bx-sort-down');
				data.table.children('thead').children('tr').children('th:eq(' + data.sort[0] + ')').addClass('sorting_desc');
			}
		} else {
			data.table.children('thead').children('tr').children('th:eq(0)').children('i').removeClass('bx-sort-alt-2');
			data.table.children('thead').children('tr').children('th:eq(0)').children('i').addClass('bx-sort-up');
			data.table.children('thead').children('tr').children('th:eq(0)').addClass('sorting');
			data.table.children('thead').children('tr').children('th:eq(0)').addClass('sorting_asc');
			data.table.children('thead').children('tr').children('th:eq(0)').children('i').css('color', '#007AC4');
		}
	} else {
		data.sort[0] = data.table.children('thead').children('tr').children('th.sorting').index();
		if (data.table.children('thead').children('tr').children('th.sorting').hasClass("sorting_asc")) {
			data.sort[1] = "asc";
		} else if (data.table.children('thead').children('tr').children('th.sorting').hasClass("sorting_desc")) {
			data.sort[1] = "desc";
		}
	}

	data.table.children('thead').children('tr').children("th[orden='No']").children('i').remove();

	var paginaSele = $(".pagesMyDataTable.active[tabla=" + data.table.attr('id') + "]").length;
	if (paginaSele == 0) {
		paginaSele = 1;
	} else {
		paginaSele = parseInt($(".pagesMyDataTable.active[tabla=" + data.table.attr('id') + "]").text());
	}

	Object.assign(data.params, { "search": $(".searcherMyDataTable[tabla=" + data.table.attr('id') + "]").val() });
	Object.assign(data.params, { "limit": $(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val() });
	Object.assign(data.params, { "page": paginaSele });
	Object.assign(data.params, { "orderCol": data.colums[data.sort[0]] });
	Object.assign(data.params, { "sort": data.sort[1] });

	$.ajax({
		url: data.url,
		type: 'POST',
		data: data.params,
		beforeSend: function () {
			$("#loading").show();
		}
	})
		.done(function (res) {
			try {
				var resA = JSON.parse(res);
				// console.log(resA);

				if (resA.data != undefined && resA.data.length > 0) {
					data.table.children('tbody').html('');

					for (var i = 0; i < resA.data.length; i++) {
						var columnas = "";
						for (var x = 0; x < data.colums.length; x++) {
							columnas += '<td>' + resA.data[i][data.colums[x]] + '</td>';
						}

						data.table.children('tbody').append('<tr id="' + resA.data[i]['ID'] + '">' + columnas + '</tr>');
					}

					if (data.totals != undefined) {
						var footer = "";

						data.table.children('thead').children('tr').children('th').each(function (index, el) {
							if (data.totals[$(this).index()] != undefined) {
								footer += "<th>" + resA.totales[data.totals[$(this).index()]] + "</th>";
							} else {
								footer += "<th></th>";
							}
						});

						data.table.children('tfoot').html("<tr>" + footer + "</tr>");
					}

					var numPaginas = parseInt(resA.totales.NumRows) / parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val());
					var residuo = parseInt(resA.totales.NumRows) % parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val());
					if (residuo > 0) {
						numPaginas = ((parseInt(resA.totales.NumRows) - residuo) / parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val())) + 1;
					}

					var paginas = "", disabled1 = "", disabled2 = "", numIni = 1, numFin = 5;
					if (numPaginas <= 10) {
						numFin = numPaginas;
					}

					if (paginaSele >= 5 && numPaginas > 10) {
						paginas += '<button type="button" class="btn btn-outline-secondary btn-sm pagesMyDataTable" tabla="' + data.table.attr('id') + '">1</button>';
						paginas += '<button type="button" class="btn btn-outline-secondary btn-sm" disabled>...</button>';

						numIni = paginaSele - 1;
						numFin = paginaSele + 1;

						if ((numPaginas - paginaSele) < 5) {
							numFin = numPaginas;
							numIni = numPaginas - 5;
						}
					}

					for (var i = numIni; i <= numFin; i++) {
						if (i == paginaSele) {
							if (i == 0) {
								disabled1 = "disabled";
							} else if (i == numPaginas) {
								disabled2 = "disabled";
							}

							paginas += '<button type="button" class="btn btn-outline-primary btn-sm pagesMyDataTable active" tabla="' + data.table.attr('id') + '">' + i + '</button>';
						} else {
							paginas += '<button type="button" class="btn btn-outline-secondary btn-sm pagesMyDataTable" tabla="' + data.table.attr('id') + '">' + i + '</button>';
						}
					}

					if (numPaginas > 10 && (numPaginas - paginaSele) >= 5) {
						paginas += '<button type="button" class="btn btn-outline-secondary btn-sm" disabled>...</button>';
						paginas += '<button type="button" class="btn btn-outline-secondary btn-sm pagesMyDataTable" tabla="' + data.table.attr('id') + '">' + numPaginas + '</button>';
					}

					if (numPaginas == 1) {
						disabled1 = "disabled";
						disabled2 = "disabled";
					}

					$("#" + data.table.attr('id') + "_Pagination").remove();

					var desde = (((paginaSele * parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val())) - parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val())) + 1);
					var hasta = (paginaSele * parseInt($(".numRowsMyDataTable[tabla=" + data.table.attr('id') + "]").val()));
					var total = parseInt(resA.totales.NumRows);

					if (hasta > total) {
						hasta = total;
					}

					data.table.parent().parent().append(`<div class="row" id="` + data.table.attr('id') + `_Pagination">
					<div class="col-12">	
						<div class="row row-cols-auto">
							<div class='col' style="padding-top: 5px;">
								<p style="font-size: 13px;">`+ new Intl.NumberFormat('en-US').format(desde) + ` - ` + new Intl.NumberFormat('en-US').format(hasta) + ` of ` + new Intl.NumberFormat('en-US').format(total) + `</p>
							</div>
						</div>
						<div class="row row-cols-auto justify-content-end" style="margin-top: -15px;">
							<div class='col'>
								<div class="btn-toolbar">
									<div class="btn-group">
										<button type="button" class="btn btn-outline-secondary btn-sm prePagButton" `+ disabled1 + `>Bfr.</button>
									    `+ paginas + `
									    <button type="button" class="btn btn-outline-secondary btn-sm nextPagButton" `+ disabled2 + `>Nxt.</button>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>`);

					// moneda();
				} else {
					data.table.children('tbody').html(`<tr>
					<td colspan="`+ data.colums.length + `">There are no entries.</td>
				</tr>`);
					data.table.children('tfoot').html("");
					$("#" + data.table.attr('id') + "_Pagination").remove();
				}
			} catch (error) {
				console.error(error);
				console.error("Error MyDataTable: " + error);
				console.log($.trim(res));
			}
		})
		.fail(function (err) {
			console.log("Error ajax MyDataTable");
		}).always(function () {
			$("#loading").hide();
		});
}

function createMyDataTable() {

	$(".myDataTable").each(function (index, el) {
		if($(this).hasClass('created')){
			return;
		}
		
		$(this).addClass('created');
		var padre = $(this).parent();
		var tabla = padre.children('table.myDataTable');
		var id = tabla.attr('id');

		tabla.children('thead').children('tr').children('th').each(function (index, el) {
			$(this).append('<i class="bx bx-sort-alt-2"></i>')
		});

		tabla.children('tbody').html(`<tr>
			<td colspan="`+ tabla.children('thead').children('tr').children('th').length + `">Loading...</td>
		</tr>`);

		var tablaHtml = padre.html();

		$(this).remove();

		padre.append(`<div class="row row-cols-auto">
				<div class='col' style="padding-top: 5px;">
					<select class="form-select numRowsMyDataTable" tabla="`+ id + `">
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="250">250</option>
					</select>
				</div>
			</div>
			<div class="row row-cols-auto justify-content-end" style="margin-top: -40px;">
				<div class='col'>
					<div class="input-group mb-3">
						<span class="input-group-text" style="color: #909090;"><i class='bx bx-search'></i></span>
						<input type="text" class="form-control searcherMyDataTable" tabla="`+ id + `" placeholder="Search..." Checks="">
					</div>
				</div>
			</div>
			</div class="row">
				<div class='col-12 table-responsive'>
					`+ tablaHtml + `
				</div>
			</div>`);
	});
}

jQuery(document).ready(function ($) {
	$(document).on('click', '.myDataTable thead tr th', function () {
		if ($(this).attr('orden') != 'No') {
			var num = $(this).index();
			$(this).addClass('sorting');
			$(this).children('i').css('color', '#007AC4');

			if ($(this).children('i').hasClass('bx-sort-alt-2')) {
				$(this).children('i').removeClass('bx-sort-alt-2');
				$(this).children('i').addClass('bx-sort-up');
				$(this).addClass('sorting_asc');
			} else if ($(this).children('i').hasClass('bx-sort-up')) {
				$(this).children('i').removeClass('bx-sort-up');
				$(this).children('i').addClass('bx-sort-down');
				$(this).removeClass('sorting_asc');
				$(this).addClass('sorting_desc');
			} else if ($(this).children('i').hasClass('bx-sort-down')) {
				$(this).children('i').removeClass('bx-sort-down');
				$(this).children('i').addClass('bx-sort-up');
				$(this).removeClass('sorting_desc');
				$(this).addClass('sorting_asc');
			}

			$(this).parent().children('th').each(function (index, el) {
				if (index != num) {
					$(this).removeClass('sorting_asc');
					$(this).removeClass('sorting_desc');
					$(this).removeClass('sorting');
					$(this).children('i').css('color', '');
					$(this).children('i').removeClass('bx-sort-up');
					$(this).children('i').removeClass('bx-sort-down');
					$(this).children('i').addClass('bx-sort-alt-2');
				}
			});

			ajaxMyDatatable(arregloDataTable[$(this).parent().parent().parent().attr('id')]);
		}
	});

	$(document).on('change', '.numRowsMyDataTable', function () {
		var tabla = $(this).attr('tabla');

		$(".pagesMyDataTable").each(function (index, el) {
			$(this).removeClass('active');
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-outline-secondary');
		});

		$(".pagesMyDataTable:eq(0)").addClass('active');
		$(".pagesMyDataTable:eq(0)").removeClass('btn-outline-secondary');
		$(".pagesMyDataTable:eq(0)").addClass('btn-primary');

		ajaxMyDatatable(arregloDataTable[tabla]);
	});

	$(document).on('keyup', '.searcherMyDataTable', function (event) {
		var tabla = $(this).attr('tabla');
		$(".pagesMyDataTable").each(function (index, el) {
			$(this).removeClass('active');
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-outline-secondary');
		});

		$(".pagesMyDataTable:eq(0)").addClass('active');
		$(".pagesMyDataTable:eq(0)").removeClass('btn-outline-secondary');
		$(".pagesMyDataTable:eq(0)").addClass('btn-primary');


		ajaxMyDatatable(arregloDataTable[tabla]);
	});

	$(document).on('click', '.pagesMyDataTable', function () {
		var tabla = $(this).attr('tabla');

		$(".pagesMyDataTable").each(function (index, el) {
			$(this).removeClass('active');
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-outline-secondary');
		});

		$(this).addClass('active');
		$(this).removeClass('btn-outline-secondary');
		$(this).addClass('btn-primary');

		ajaxMyDatatable(arregloDataTable[tabla]);
	});

	$(document).on('click', '.prePagButton', function () {
		var num = $(this).parent().children('button.active').index();
		$(this).parent().children('button:eq(' + (num - 1) + ')').trigger('click');
	});

	$(document).on('click', '.nextPagButton', function () {
		var num = $(this).parent().children('button.active').index();
		$(this).parent().children('button:eq(' + (num + 1) + ')').trigger('click');
	});

	function between(x, min, max) {
		return x >= min && x <= max;
	}
});