<?php
class Tax_calculation
{
	function getGstIncluded($amount,$percent,$cgst,$sgst)
	{
		$gst_amount = $amount-($amount*(100/(100+$percent)));
		$percentcgst = $gst_amount/2;
		$percentsgst =  $gst_amount/2;
		$display = "<p>";
		
		if($cgst && $sgst)
		{
			$gst = $percentcgst + $percentsgst;
			$display .= " CGST = ".number_format($percentcgst, 2)." SGST = " . number_format($percentsgst, 2);
		}
		elseif($cgst)
		{
			$gst = $percentcgst;
			$display .= " CGST = ".number_format($percentcgst, 2);
		}
		else
		{
			$gst = $percentsgst;
			$display .= " SGST = ".number_format($percentsgst,2);
		}
		$withoutgst = $amount - $gst_amount;
		$withgst = $withoutgst + $gst_amount;
		$display .="</p>";
		$display .="<p>".number_format($withoutgst,2) . " + " . number_format($gst,2) . " = " . number_format($withgst,2)."</p>";
		return $display;
	}
	
	function getGstExcluded($amount,$percent,$cgst,$sgst)
	{
		$gst_amount = ($amount*$percent)/100;
		$amountwithgst = $amount + $gst_amount;   
		$percentcgst = $gst_amount/2;
		$percentsgst =  $gst_amount/2;
		$display="<p>";
		
		if($cgst && $cgst)
		{
			$gst = $percentcgst + $percentsgst;
			$display .= " CGST = ".number_format($percentcgst, 2)." SGST = " . number_format($percentsgst, 2);
		}
		elseif($cgst)
		{
			$gst = $percentcgst;
			$display .= " CGST = ".number_format($percentcgst, 2);
		}
		else
		{
			$gst = $percentsgst;
			$display .= " SGST = ".number_format($percentsgst, 2);
		}
		$display .="</p>";
		$display .="<p>".$amount . " + " . number_format($gst,2) . " = " . number_format($amountwithgst,2)."</p>";
		return $display;
	}
	
	function get_gst_inc($amount,$percent)
	{
		$gst_amount = $amount-($amount*(100/(100+$percent)));
		$percentcgst = number_format($gst_amount/2, 2);
		$percentsgst = number_format($gst_amount/2, 2);
		$withoutgst = $amount - $gst_amount;
		
		$total = number_format($withoutgst+$gst_amount, 2);
		
		$return_data = number_format($withoutgst, 2)." + ".number_format($gst_amount,2)." ( CGST = ".$percentcgst." SGST = " . $percentsgst." ) = " . $total;
		return $return_data;
	}

	function get_gst_exc($amount,$percent)
	{
		$gst_amount = ($amount*$percent)/100;
		$total = number_format($amount+$gst_amount, 2);
		$percentcgst = number_format($gst_amount/2, 2);
		$percentsgst = number_format($gst_amount/2, 2);

		$return_data = $amount." + ".number_format($gst_amount,2)." ( CGST = ".$percentcgst." SGST = " . $percentsgst." ) = " . $total;
		return $return_data;
	}
}

$amount = 500000;
$percent = 12;

$getData = new Tax_calculation();

echo "<div>";
echo "Include GST:";
echo "<br/>";
echo $getData->get_gst_inc($amount,$percent);

echo "<br/><br/>";
echo "Exclude GST:";
echo "<br/>";
echo $getData->get_gst_exc($amount,$percent);
echo "</div>";

$cgst = 1;
$sgst = 0;

echo "<br/><br/><br/>";
echo "<div>";
echo "Include TAX  AND Exclude SGST:";
echo "<br/>";
echo $getData->getGstIncluded($amount,$percent,$cgst,$sgst);

echo "<br/><br/>";
echo "Exclude TAX AND Exclude SGST:";
echo "<br/>";
	
echo $getData->getGstExcluded($amount,$percent,$cgst,$sgst);

echo "</div>";
?>