<!DOCTYPE html>
<?php
    include('header.php');
?>

 <div id="main_body">
            <h2>Contact</h2>
            <p>Please complete the form below with your query or feedback and our Customer Services Team will be more than happy to help you. Why not check out our <a href="FAQTaC.php">FAQ</a> to see if there is an answer to your query.</p>
            <form action="MAILTO:shoes@fakeemail.com" method="post" enctype="text/plain">
                <p>Name: <input name="name" required size="35" id="name" type="text"></p>
                <p>Email: <input name="email" required size="35" id="email" type="email"></p>
                <p>Subject: <select id="subject" name="subject" required>
                    <option disabled value="default">Select Subject</option>
                    <option disabled>------------------</option>
                    <option value="delivery">Delivery</option>
                    <option value="general">General Enquiry</option>
                    <option value="payment">Payment</option>
                    <option value="issue">Product Issue</option>
                    <option value="returns">Returns</option>
                    <option value="technical">Technical Issue</option>
                </select></p>
                <p>Message:</p>
                <textarea name="message" id="message" cols="38" rows="5">
                
                </textarea><br>
                <button class="basket" id="send">Send Message</button>
                <button class="basket" type="reset" id="reset">Reset</button>
            </form>
        </div>

<?php
    include('footer.php');
?>