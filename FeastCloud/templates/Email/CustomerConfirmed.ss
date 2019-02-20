<h3>Order Details</h3>

<b>Name:</b> $Name <br/>
<b>Email:</b> $Email <br/>
<b>Phone:</b> $Phone <br/>
<b>PickUpTime:</b> $PickUpTime <br/>
<b>Message:</b> $Message <br/>
<br/>
<b>Order Items:</b><br>
<table style="border: 1px solid #888888" cellspacing="0">
    <tr><td style="padding:10px;border: 1px solid #888888"><u>Item</u></td><td style="padding:10px;border: 1px solid #888888"><u>Price</u></td><td style="padding:10px;border: 1px solid #888888"><u>Qty</u></td></tr>
    <% loop $OrderItems %>
        <tr><td style="padding:10px;border: 1px solid #888888">$Title</td><td style="padding:10px;border: 1px solid #888888">$Price</td><td style="padding:10px;border: 1px solid #888888">$Qty</td></tr>
    <% end_loop %>
</table>
<br/>
<br/>
<b>Total:</b> $Total <br/>
<b>Tax:</b> $Tax <br/>
<b>Discount:</b> $Discount <br/>
<b>NetTotal:</b> $NetTotal <br/>