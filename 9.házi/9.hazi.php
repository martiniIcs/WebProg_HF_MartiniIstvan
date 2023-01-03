<?php

function Get(string $url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, false);
    return $response;
}

if(isset($_POST['submit'])){
    if(isset($_POST['id'])){
        $osszeg = 0;
        $url = "https://fakestoreapi.com/carts/user/" .$_POST['id'];
        $data = Get($url);

        foreach($data as $cart){
            foreach($cart->products as $product){
                $crproduct = Get("https://fakestoreapi.com/products/" . $product->productId);
                $osszeg += $crproduct->price * $product->quantity;
            }
        }

        echo "<br>The total is: ";
        echo $osszeg ;
    }
}

?>



<form action="index.php" method="post">
    <input type="number" name="id" placeholder="ID" >
    <input type="submit" value="Submit" name="submit">
</form>