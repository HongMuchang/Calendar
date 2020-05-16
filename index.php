<?php
//GET取得
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // 今月の年月を表示
    $ym = date('Y-m');
}

// タイムスタンプを作成,確認する
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

$today = date('Y-m-j');
$html_title = date('Y年n月', $timestamp);
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
$youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

// カレンダー作成の準備
$weeks = [];
$week = '';
$week .= str_repeat('<td></td>', $youbi);

for ($day = 1; $day <= $day_count; $day++, $youbi++) {
    $date = $ym . '-' . $day;

    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';

    // 週終わり、月終わり処理
    if ($youbi % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // 月の最終日の場合、空セルを追加
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }
        // weeks配列にtrと$weekを追加する
        $weeks[] = '<tr>' . $week . '</tr>';
        // weekをリセット
        $week = '';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>万年カレンダー</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="worper">
        <form name="myForm">
            <input type="text" size="20" name="myFormMes" />
        </form>
        <div class="container">
            <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a
                    href="?ym=<?php echo $next; ?>">&gt;</a></h3>
            <table class="table table-bordered">
                <tr class="thead-dark">
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
                <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
                ?>
            </table>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>