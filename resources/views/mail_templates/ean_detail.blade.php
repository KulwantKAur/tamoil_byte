<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
	<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<!--[if !mso]><!-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<![endif]-->
	<title></title>
	<!--[if !mso]><!-->
	<!--<![endif]-->
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
	</style>
	<style type="text/css" id="media-query">
		@media (max-width: 660px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col>div {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				max-width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num8 {
				width: 66% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}
		}
	</style>
</head>

<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
	<!--[if IE]><div class="ie-browser"><![endif]-->
	<table class="nl-container" style="t border-collapse: collapse; able-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" cellpadding="0" cellspacing="0" role="presentation" width="100%" bgcolor="#FFFFFF" valign="top">
		<tbody>
			<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
						<table style="Margin: 0 auto;width:100%;max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #5c98c7; border-collapse: collapse; white-space:nowrap;">
							<tr>
								<td>
									<table style="Margin: 0 auto;width: 100%;">
										<tr>
											<td style="color:#fff; font-size: 18px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:20px;">
												Hallo Team Kundensupport,<br>
												<a href="https://app.billbee.io/de/Order/OpenOrderInExtSystem?orderId={{$Referen}}" >{{$Referen}}</a> wurde erfolgreich<br>
												angenommen. <br> Bemerkungen:
												@foreach($pro_detail as $commentDetail)
													@if ($loop->first)
														{{$commentDetail['comment']}}
													@endif
												@endforeach
											</td>
										</tr>
									</table>
								</td>
							</tr>
								<td>
									<table style="Margin: 0 auto;width: 100%; background:#6da3cd; border-collapse: collapse;">
										<tr>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;white-space:nowrap;">
												<strong>EAN</strong>
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;white-space:nowrap;">
												<strong>Produkt</strong>
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;white-space:nowrap;">
												<strong>Anzahl / St�ck</strong>
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;white-space:nowrap;">
												<strong>Produkt Zustand</strong>
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;white-space:nowrap;">
												<strong>Grund</strong>
											</td>
										</tr>
										@foreach($pro_detail as $detail)
										<tr>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;border-top:1px solid #d0d0d0;">
											{{$detail['ean']}}
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;border-top:1px solid #d0d0d0;">
											{{$detail['title']}}
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;border-top:1px solid #d0d0d0;">
											{{$detail['delta_quantity']}}
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;border-top:1px solid #d0d0d0;">
											{{$detail['product_grade']}}
											</td>
											<td style="color:#fff; font-size: 14px;line-height: 1.2;color: #ffffff;font-family: Lato,Tahoma,Verdana,Segoe,sans-serif; padding:15px 20px;border-top:1px solid #d0d0d0;">
											{{$detail['reason_code']}}
											</td>
										</tr>
										@endforeach
									</table>
								</td>
							</tr>
						</table>
				</td>
			</tr>
		</tbody>
	</table>
	<!--[if (IE)]></div><![endif]-->
</body>

</html>
