<?php
	if( !isset($_REQUEST['order_id']) || !isset($_REQUEST['duration']) || !isset($_REQUEST['interest']) ) {
		header('location:');
	} else {
		$order_id = $_REQUEST['order_id'];
		$duration = $_REQUEST['duration'];
		$interest = $_REQUEST['interest'];
		require_once __DIR__ . '/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('Vehicle Conditions of Sale');
		ob_start();
		$x = ob_get_contents();
		$x = '
<style type="text/css" media="screen">
	li{
		margin-bottom: 5px;
	}	
</style>
<p>
	These conditions govern the sale of the Vehicles by cidi Ltd. to you. Please read these conditions carefully before placing an order with cidi Ltd. By placing an order with cidi Ltd., you signify your agreement to be bound by these conditions.
</p>
<br/>
<div>
	<h3>1. DEFINITIONS AND INTERPRETATION</h3>
	<ul style="list-style-type:none;">
		<li>
			1.1 In these terms unless the context requires otherwise:
			<ul style="list-style-type: none;">
				<li>(a) <strong>"Completion"</strong> means the completion of the transaction, comprising of the payment for the Vehicle by the Purchaser, and acceptance of payment by the Seller;</li>
				<li>(b) <strong>"Contract"</strong> means the contract for the sale and purchase of the Vehicle;</li>
				<li>(c) <strong>"Estimated Delivery Date"</strong> means the estimated delivery date (if any) specified on the Order;</li>
				<li>(d) <strong>"Manufacturer"</strong> means the manufacturer of the Vehicle;</li>
				<li>(e) <strong>"Order"</strong> means the order for the purchase of the Vehicle;</li>
				<li>(f) <strong>"Parties"</strong> means the Purchaser and the Seller collectively;</li>
				<li>(g) <strong>"Purchase Price"</strong> means the price for the Vehicle (including, where applicable, accessories, road fund licence, delivery, warranty, insurance, fuel, car tax and value added tax) current at the date of the Order;</li>
				<li>(h) <strong>"Purchaser"</strong> means the person, firm or company placing the Order;</li>
				<li>(i) <strong>"Seller"</strong> means cidi Ltd. and includes its successors and assigns; and,</li>
				<li>(j) <strong>"Vehicle"</strong> means the motor vehicle and any parts, accessories and extras detailed in the Order.</li>
			</ul>
		</li>
		<li>1.2 Headings are for convenience only and do not affect the construction of the Contract; the masculine shall include all genders and the singular shall include the plural.</li>
		<li>1.3 Any reference to statutory provisions is a reference to such statutory provisions as amended or reenacted from time to time.</li>
		<li>1.4 These terms together with the terms set out in the Order are the only terms of the Contract.</li>
		<li>1.5 No variation to the Contract is effective unless agreed in writing by an authorised representative of the Seller.</li>
	</ul>

</div>

<div>
	<h3>2. FORMATION OF CONTRACT</h3>
	<ul style="list-style-type:none;">
		<li>(a) The Order is the Purchaser’s offer to purchase the Vehicle upon these terms.</li>
		<li>(b) The Contract is formed upon the Seller accepting that offer by accepting payment from the Purchaser.</li>
		<li>(c) The Contract is personal to the Purchaser, who shall not assign the benefit of the Contract without the prior written consent of an authorised representative of the Seller.</li>
	</ul>
</div>

<div>
	<h3>3. CREATION OF CO-OWNERSHIP VIA JOINT TENANCY</h3>
	<p>The Parties agree to co-ownership, of the Vehicle, under a joint tenancy, subject to the following covenants:</p>
	<ol start="4">
		<li>Ownership: The Purchaser shall obtain ownership of the Vehicle in direct proportion to the percentage of funds contributed to the total Purchase Price.</li>
		<li>Legal Title: Notwithstanding the Seller having received in cleared funds, from the Purchaser payment of all sums payable for the Vehicle:
			<ol type="a">
				<li>the Purchaser agrees that both the Seller and the Purchaser shall have equal legal title to the Vehicle;</li>
				<li>the Purchaser agrees to refrain from exercise of their legal title for the duration of the contract;</li>
				<li>in the event of a breach of contract the Purchaser shall have the right to exercise their legal title;</li>
				<li>any benefits accruing from the Vehicle to the co-owners, will be subject to the policies maintained in place by the Seller for the duration of the contract.</li>
			</ol>
		</li>
		<li>Vehicle Management: The Purchaser grants universal and unrestricted rights of responsibility for Vehicle management to the Seller.  For the purposes of this agreement this includes all:
			<ol type="i">
				<li>decision making relating to the Vehicle;</li>
				<li>responsibility for maintenance and repair;</li>
				<li>garaging (access and protection) of the Vehicle;</li>
				<li>insurance, liability and indemnity requirements relating to the Vehicle.</li>
			</ol>
		</li>
		<li>Vehicle Use: The Purchaser grants universal and unrestricted rights of access and use of the Vehicle to the Seller.</li>
	</ol>
</div>

<div>
	<h3>4. RELINQUISHMENT OF TITLE</h3>
	<p>
		The Purchaser agrees to relinquish both legal and beneficial title to the Vehicle upon termination of this contract.
	</p>
</div>

<div>
	<h3>5. CANCELLATION</h3>
	<ul style="list-style-type: none;">
		<li>(a) If the Vehicle is purchased at a distance, within the meaning of The Consumer Contracts (Information Cancellation and Additional Charges) Regulations 2013, the Purchaser may within 14 days of contract formation as defined by clause 2, cancel the Contract and require the Seller to refund the Purchase Price.</li>
		<li>(b) Pursuant to clause 5(a), in the event of cancellation by the Purchaser,  an administration fee of 20% of the total Purchase Price will be charged by the Seller, in addition to any costs incurred as a consequence of the cancellation.</li>
		<li>(c) Any cancellation initiated by the Purchaser that falls outside of 5(a) will result in forfeiture of the entire Purchase Price paid by the Purchaser.</li>
	</ul>
</div>

<div>
	<h3>6. MODEL VARIATION</h3>
	<p>
		The Seller reserves the right to vary the Vehicle model selected by the Purchaser.
	</p>
</div>

<div>
	<h3>7. METHOD OF PAYMENT</h3>
	<p>
		Unless otherwise agreed by the Seller the Purchaser shall pay the Purchase Price in cleared funds by electronic transfer, credit and/or debit card payment. 
	</p>
</div>

<div>
	<h3>8. GUARANTEED BUYBACK</h3>
	<ul style="list-style-type: none;">
		<li>(a) After a period of [duration] following the date of contract formation under clause 2,  the Seller will be obligated to undertake the mandatory buyback of the Vehicle.</li>
		<li>(b) The mandatory buyback of the Vehicles under clause 8(a) shall constitute termination of the original contract of sale between the Seller and the Purchaser. </li>
		<li>(c) Consideration will be paid in Euros by the Seller for each of the Vehicles repurchased, at a price which accurately reflects a return of [interest] of the original purchase price per Vehicle.</li>
	</ul>
</div>

<div>
	<h3>9. RENEWAL OF PURCHASE </h3>
	<ul style="list-style-type: none;">
		<li>(a) In the absence of any waiver in writing by the Purchaser, all consideration obtained as a result of the mandatory buyback of the Vehicles shall be automatically used to purchase new Vehicles.</li>
		<li>(b) Any new purchases made pursuant to this Renewal of Purchase clause shall constitute a new sales contract between the Seller and the Purchaser, and are deemed to be subject to the same conditions as originally agreed upon by the Parties under the terms set out in this contract.</li>
	</ul>
</div>

<div>
	<h3>10. WARRANTY AND PRODUCER DETAILS</h3>
	<p>
		The Vehicle is sold with the benefit of the Manufacturer’s warranty, the terms of which are specified in the service record and warranty booklet or other similar documentation issued from time to time by the Manufacturer. The benefit of such warranty is in addition to any statutorily implied warranty on the part of the Seller.
	</p>
</div>

<div>
	<h3>11. RISK AND INSURANCE</h3>
	<p>
		cidi Limited shall ensure that the Vehicles are at all times insured to their full replacement, or reinstatement value with a reputable insurer against fire and all other risks customarily insured against, and will at all material times adequately insure against accident, damage, injury, third party loss and all other risks customarily insured against.
	</p>
</div>

<div>
	<h3>12. LIMITS OF LIABILITY</h3>
	<ul style="list-style-type: none;">
		<li>(a) The Seller’s total liability for the aggregate claims of the Purchaser arising out of a single act or default of the Seller (whether due to the Seller’s negligence or otherwise) shall not exceed the Purchase Price plus [interest] of the purchase price.</li>
		<li>(b) Nothing in this Contract shall be construed as limiting or excluding any liability of the Seller which may not by law be excluded.</li>
	</ul>
</div>

<div>
	<h3>13. TERMINATION</h3>
	<ul style="list-style-type: none;">
		<li>(a) Without prejudice to any of its other rights and remedies, the Seller shall be entitled (without penalty) to postpone delivery of the Vehicle and suspend performance of the Contract, and may by notice in writing to the Purchaser, terminate the Contract at any time.</li>
	</ul>
</div>

<div>	
	<h3>14. AMENDMENTS TO THE CONDITION OF SALE</h3>
	<ul style="list-style-type: none;">
		<li>(a) We reserve the right to make changes to our website, policies, and terms and conditions, including these Conditions of Sale at any time.</li>
		<li>(b) You will be subject to the terms and conditions, policies and Conditions of Sale in force at the time that you order products from us, unless any change to those terms and conditions, policies, or these Conditions of Sale is required to be made by law or government authority (in which case it may apply to orders previously placed by you).</li>
	</ul>
</div>

<div>
	<h3>15. FORCE MAJEURE</h3>
	<p>
		The Seller shall not be liable to the Purchaser if unable to carry out any provision of the Contract for any reason beyond its control including (without limitation) Act of God, legislation, war, civil commotion, fire, flood, drought, failure of power supply, lock-out, strike, stoppage or other action by employees or third parties in contemplation, or furtherance of any dispute, or owing to the inability to procure parts or any vehicle required for the performance of the Contract. Failure to deliver the Vehicle by reason of any of the aforementioned contingencies shall entitle the Purchaser to cancel the Contract and the provisions of Force Majeure Clause shall apply.
	</p>
</div>

<div>
	<h3>16. NOTICES AND GENERAL PROVISIONS</h3>
	<ul style="list-style-type: none;">
		<li>(c) Any notice under these terms and conditions shall be properly given if in writing and sent by email to info@cidi.group. For the purposes of this clause the date and time when the notice is deemed to have been received by email will be no later than 5 (five) Business Days after the time of transmission.</li>
		<li>(d) A person who is not a party to this Contract has no right under the Contracts (Rights of Third Parties) Act 1999 to enforce any term of this Contract but this does not affect any remedy or right of a third party which exists or is available apart from that Act.</li>
		<li>(e) This contract is subject to the law of England and Wales. The parties submit to the exclusive jurisdiction of the courts of England and Wales.</li>
	</ul>
</div>';
	$x = str_replace('[duration]',$duration,$x);
	$x = str_replace('[interest]',$interest,$x);
	$mpdf->WriteHTML($x);
	ob_end_clean();

	// Open into Same window //
	//$mpdf->Output('Vehicle Conditions of Sale - '.$order_id.'.pdf', 'I');

	// Download File //
	$mpdf->Output('Vehicle Conditions of Sale - '.$order_id.'.pdf', 'D');
}
?>