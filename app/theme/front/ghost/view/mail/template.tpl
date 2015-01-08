<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title></title>
                                                                                                                                                                                                                                                                                                                                                                                                        
<style type="text/css">
	.ReadMsgBody {width: 100%; background-color: #ffffff;}
	.ExternalClass {width: 100%; background-color: #ffffff;}
	body	 {width: 100%; background-color: #E9E8DD; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Helvetica, Arial, sans-serif}
	table {border-collapse: collapse;}
	.boxed {border-collapse: separate; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; border: 1px solid #CDCBC0; -webkit-box-shadaw: 0 1px 2px rgba(0, 0, 0, .15); -moz-box-shadaw: 0 1px 2px rgba(0, 0, 0, .15); box-shadow: 0 1px 2px rgba(0, 0, 0, .15);}
	
	@media only screen and (max-width: 640px)  {
					body[yahoo] .deviceWidth {width:440px!important; padding:0;}	
					body[yahoo] .center {text-align: center!important;}	 
			}
			
	@media only screen and (max-width: 479px) {
					body[yahoo] .deviceWidth {width:280px!important; padding:0;}	
					body[yahoo] .center {text-align: center!important;}	 
			}

</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Helvetica, Arial, sans-serif">

<!-- Wrapper -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="100%" valign="top" bgcolor="#E9E8DD" style="padding-top:20px">
		
			<!-- One Column -->
			<table width="580"  class="deviceWidth boxed" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#E9E8DD">
				<tr>
					<td valign="top" align="center" style="padding:0;padding-top:10px" bgcolor="#ffffff">
						<a href="<?= $this->app['http.server']; ?>"><img  class="deviceWidth" src="<?= $this->app['http.server']; ?>image/email/logo.png" alt="" border="0" style="display: block;" /></a>						
					</td>
				</tr>
                <tr>
                    <td style="font-size: 13px; color: #212425; font-weight: normal; text-align: left; font-family: Helvetica, Arial, sans-serif; line-height: 18px; vertical-align: top; padding:10px 8px 10px 8px" bgcolor="#ffffff">
                        
						<?= $content; ?>
				
                    </td>
                </tr>
                <tr>
					<td valign="top" style="padding:0;height:28px;" height="28" bgcolor="#ffffff"></td>
				</tr>            
			</table><!-- End One Column -->

			<div style="height:20px">&nbsp;</div><!-- spacer -->


			<!-- 4 Columns -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td bgcolor="#363636" style="padding:30px 0">
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                            <tr>
                                <td>                    
                                        <table width="45%" cellpadding="0" cellspacing="0"  border="0" align="left" class="deviceWidth">
                                            <tr>
                                                <td valign="top" style="font-size: 11px; color: #f1f1f1; color:#999; font-family: Arial, sans-serif; padding-bottom:20px" class="center">

												<?= $text_subscribed; ?>
												
												<br/><br/>

												<?= $text_unsubscribe; ?>

                                                </td>
                                            </tr>
                                        </table>
                        
                                        <table width="40%" cellpadding="0" cellspacing="0"  border="0" align="right" class="deviceWidth">
                                            <tr>
                                                <td valign="top" style="font-size: 11px; color: #f1f1f1; font-weight: normal; font-family: Helvetica, Arial, sans-serif; vertical-align: top; text-align:right" class="center">
													
													<?= $text_address_block; ?>

                                                </td>
                                            </tr>
                                        </table>   
                        
                        		</td>
                        	</tr>
                        </table>                                                              		
                    </td>
                </tr>
            </table><!-- End 4 Columns -->
						
		</td>
	</tr>
</table> <!-- End Wrapper -->

</body>
</html>
