<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}
			.paid-stamp {
			position: absolute;
			top: 3px;
			right: 15px;
			padding: 5px;
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
			font-weight: bold;
			text-transform: uppercase;
		}

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
				border-collapse: collapse;
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
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<div class="paid-stamp">@if($data->status != '0')
			<a style="color:green">PAID</a>
			@else
			<a style="color:red">UNPAID</a>
			@endif
		</div>
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ asset('assets') }}/img/logos/b.png" style="width: 100%; max-width: 80px" />
								</td>

								<td>
									Invoice #: {{ $data->no_invoice }}<br />
									Created: {{ \Carbon\Carbon::parse($data->created_at)->tz('Asia/Jakarta')->format('d F Y') }}
                                    <br />
                                    Due: {{ \Carbon\Carbon::parse($data->created_at)->tz('Asia/Jakarta')->addDays(3)->format('d F Y') }} <br/>
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
									Swadana Bali Tours<br />
									Jalan Cempaka<br />
									Mas, Ubud, Bali
								</td>

								<td>
									{{ $user->username }}.<br />
									{{ $user->email }}<br />
									{{ $user->address }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Transfer</td>
				</tr>

				<tr class="details">
					<td>BRI</td>

					<td>{{ $bank->no_rek }}</td>
				</tr>

				<tr class="heading">
                    @if($data->car_id != '')
					<td>Rent Car</td>

					<td>Price</td>
                    @else
                    <td>Rent Motor</td>

					<td>Price</td>
                    @endif
				</tr>

				<tr class="item">
					@if($data->car_id != '')
					<td>{{ $data->car->nama_mobil }} ({{ $daysrent }} days)</td>

					<td>Rp {{ number_format($data->pay, 0, ',', '.') }}</td>
					@else
					<td>{{ $data->motor->nama_motor }} ({{ $daysrent }} days)</td>

					<td>Rp {{ number_format($data->pay, 0, ',', '.') }}</td>
					@endif
				</tr>

				{{-- <tr class="item last">
					<td>Fine ({{ $daysfine }} days)</td>

					<td>
                        @if($data->fine == '')
                        Rp 0
                        @else
                        Rp {{ number_format($data->fine, 0, ',', '.') }}
                        @endif
                    </td>
				</tr> --}}

				<tr class="total">
					<td></td>

					<td>Total: Rp {{ number_format($data->pay, 0, ',', '.') }}</td>
				</tr>
			</table>
		</div>
		
	</body>
</html>

