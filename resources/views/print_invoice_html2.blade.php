<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>
		<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
		{{-- <link href="{{ asset('css/invoice_style.css') }}" rel="stylesheet"> --}}

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									Invoice #: 123<br />
									Created: January 1, 2015<br />
									Due: February 1, 2015
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Sparksuite, Inc.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

								<td>
									Acme Corp.<br />
									John Doe<br />
									john@example.com
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Item</td>
				
					<td>Price</td>
				</tr>

				<tr class="item">
					<td>Website design</td>

					<td>$300.00</td>
				</tr>

				<tr class="item">
					<td>Hosting (3 months)</td>

					<td>$75.00</td>
				</tr>

				<tr class="item last">
					<td>Domain name (1 year)</td>

					<td>$10.00</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: $385.00</td>
				</tr>
			</table>
		</div>
	</body>





	<div class="flex-grow-1">
		<!--begin::Table-->
		<div class="table-responsive border-bottom mb-9">
			<table class="table mb-3">
				<thead>
					<tr class="border-bottom fs-6 fw-bolder text-muted">
						<th class="min-w-175px pb-2">Description</th>
						<th class="min-w-70px text-end pb-2">Hours</th>
						<th class="min-w-80px text-end pb-2">Rate</th>
						<th class="min-w-100px text-end pb-2">Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr class="fw-bolder text-gray-700 fs-5 text-end">
						<td class="d-flex align-items-center pt-6">
						<i class="fa fa-genderless text-danger fs-2 me-2"></i>Creative Design</td>
						<td class="pt-6">80</td>
						<td class="pt-6">$40.00</td>
						<td class="pt-6 text-dark fw-boldest">$3200.00</td>
					</tr>
					<tr class="fw-bolder text-gray-700 fs-5 text-end">
						<td class="d-flex align-items-center">
						<i class="fa fa-genderless text-success fs-2 me-2"></i>Logo Design</td>
						<td>120</td>
						<td>$40.00</td>
						<td class="fs-5 text-dark fw-boldest">$4800.00</td>
					</tr>
					<tr class="fw-bolder text-gray-700 fs-5 text-end">
						<td class="d-flex align-items-center">
						<i class="fa fa-genderless text-primary fs-2 me-2"></i>Web Development</td>
						<td>210</td>
						<td>$60.00</td>
						<td class="fs-5 text-dark fw-boldest">$12600.00</td>
					</tr>
				</tbody>
			</table>
		</div>

</html>