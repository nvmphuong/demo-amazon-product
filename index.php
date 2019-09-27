<?php
use App\ShopGateway;

require_once 'bootstraps.php';

?>
<html>

<body>
<div style="width: 800px;margin: 0 auto;max-width: 100vw">

    <h2>Please provide amazon product url</h2>

    <form action="">
        <input style="width: 100%;padding: 10px" type="text" name="url" value="<?php echo $_GET['url']??'' ?>">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if (!isset($_GET['url'])) {
        return;
    }
    $error = null;
    $result = null;
    try {
        $url = $_GET['url'];
//init gateway
        $gateWay = new ShopGateway(config('shop'));

//get shop service depend on user url
        $shopService = $gateWay->getShopService($url);
        if (!$shopService) {
            throw new Exception('This domain is not our partner.');
        }
//get product detail
        $result = $shopService->getProductDetail($url);
    } catch (Exception $exception) {
        $error = $exception->getMessage();
    }
    if ($error) {
        echo "<h2 style='color: red'>$error</h2>";
    } else {
        ?>

        <?php if ($result && $result['name']) { ?>
            <h4><?php echo $result['name'] ?></h4>
        <?php } ?>

        <?php if ($result && $result['price']) { ?>
            <p>Price: <?php echo round($result['price'], 2) ?>$</p>
        <?php } ?>

        <?php if ($result && $result['shipping_fee']) { ?>
            <p>Shipping fee: <?php echo round($result['shipping_fee'], 2) ?>$</p>
        <?php } ?>

        <?php if ($result && $result['type']) { ?>
            <p>Product type (random): <?php echo $result['type'] ?></p>
        <?php } ?>
        <?php if ($result && $result['attributes']) { ?>
            <table>
                <tbody>
                <?php foreach ($result['attributes'] as $key => $value) { ?>
                    <tr>
                        <td width="50%"><b><?php echo $key; ?></b></td>
                        <td><?php echo $value; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    <?php } ?>

</div>
</body>
</html>