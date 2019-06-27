<?php

use app\models\Expert;
use app\models\Project;
use app\models\Comment;
use yii\helpers\Url;
/** @var  $comment app\models\Comment*/

//var_dump($comment);die;



$phpWord = new PhpOffice\PhpWord\PhpWord();


$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(14);


$properties = $phpWord->getDocInfo();
$properties->setCreator($comment->user->expert->name);
$properties->setCompany('ВІНБУД-ЕКСПЕРТ');

$sectionStyle = array(
    'orientation' => 'landscape',
    'pageNumberingStart' => 1,
    'marginLeft' => 700,
    'marginRight' => 700,
    'marginTop' => 700,
);

$Style = array(
    'align'=>'center'
);

$section = $phpWord->addSection($sectionStyle);
$section->addImage('blanktitle.jpg', array('width'=>780, 'height'=>80));
$section->addText('ТАБЛИЦЯ ЗНЯТТЯ ЗАУВАЖЕНЬ ТА РЕКОМЕНДАЦІЙ ЕКСПЕРТИЗИ', array('size'=>16, 'bold'=>true), $Style);
$section->addText('до проектої документації', array('size'=>16), $Style);

$tex = $comment->projects->exp;
switch ($tex) {
    case 0:
        $text='РП';
        break;
    case 1:
        $text='П';
        break;
    case 2:
        $text='TEO';
        break;
    case 3:
        $text='TEP';
        break;
    case 4:
        $text='EП';
        break;

}
//if($text==0) $text='РП';
//elseif($text==1) $text='П';
//elseif($text==2) $text='TEO';
//elseif($text==3) $text='TEP';
//elseif($text==4) $text='EП';


$section->addText('стадія проектування - "' . $text . '"', array('size'=>16), $Style);
$section->addText('"'. $comment->projects->title . '"', array('size'=>16, 'bold'=>true), $Style);

$tableStyle = array(
    'borderColor' => '#006699',
    'borderSize'  => 6,
    'cellMargin'  => 50
);
$firstRowStyle = array('bgColor' => '#66BBFF');
$table=$section->addTable();
$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);

$table->addRow(2);
$table->addCell(3000)->addText('Справа - ', array('bold' => true));
$table->addCell(15000)->addText('№ ' . $comment->projects->number);

$table->addRow(2);
$table->addCell(3000)->addText('Замовник  - ', array('bold' => true));
$table->addCell(15000)->addText($comment->projects->client);

$table->addRow(2);
$table->addCell(3000)->addText('Генеральний пректувальник ', array('bold' => true));
$table->addCell(15000)->addText($comment->projects->general);

$table->addRow(2);
$table->addCell(3000)->addText('Пректувальник  - ', array('bold' => true));
$table->addCell(15000)->addText($comment->projects->designer);

$table->addRow(2);
$table->addCell(3000)->addText('Експерт розділу  - ', array('bold' => true));
$table->addCell(15000)->addText($comment->user->expert->name . ', ' . $comment->user->expert->mobile,
                                            array('bold' => true, 'italic' =>true));

$table->addRow(2);
$table->addCell(3000);
$table->addCell(15000)->addText($comment->user->expert->description, array('italic'=>true));





$section->addText(' ');
$table=$section->addTable();
$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
$cellStyle = array('borderColor' => '000000',
    'borderSize'  => 6,
    'valign' => 'center',
    'bgColor' => '#DDDDDD'
    );
$table->addRow(2,array('borderColor' => '006699',
    'borderSize'  => 6,));
$table->addCell(200, $cellStyle)->addText('№ п/п', array(), array('align' => 'center'));
$table->addCell(7000,$cellStyle)->addText('Зауваження та рекомендації експертизи <w:br/> (№ та зміст зауваження експерта)', array(), array('align' => 'center'));
$table->addCell(6000,$cellStyle)->addText('Відповіді проектної організації на зауваження та рекомендації експертизи', array(), array('align' => 'center'));
$table->addCell(3000,$cellStyle)->addText('Позначки про виконання зауважень. <w:br/> Підпис експерта', array(), array('align' => 'center'));
$table->addCell(700,$cellStyle)->addText('Примітки', array(), array('align' => 'center'));


$cellStyle = array('borderColor' => '000000',
    'borderSize'  => 6,
    'valign' => 'center',
    'max-width' =>7000,
);
$table->addRow(2, array('borderColor' => '006699',
    'borderSize'  => 6,));
$table->addCell(200, $cellStyle)->addText('1', array(), array('align' => 'center'));
$table->addCell(7000, $cellStyle)->addText(htmlspecialchars($comment->text));;
$table->addCell(6000, $cellStyle);
$table->addCell(3000, $cellStyle);
$table->addCell(700, $cellStyle);

$section->addText(' ');
$table=$section->addTable();
$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
$table->addRow();
$table->addCell(5000)->addText('Головний інженер проекту');
$table->addCell(5000, array('borderBottomColor' => '000000',
    'borderBottomSize'  => 6,));
$table->addCell(5000)->addText($comment->projects->engineer , array(), array('align' => 'center'));



$file = $comment->id . '_' . $comment->projects->number;
$document = \PhpOffice\PhpWord\IOFactory::CreateWriter($phpWord, 'Word2007');
$document->save('../documentsWord/' . $file . '.docx');
Expert::findOne(1)->sendMailForAdmin('forAdmin', 'Зауваження оформлені',
    ['paramExample' => $comment->id, 'name'=> $comment->user->expert->name, 'project' => $comment->projects->number]);
?>
<?php if(Yii::$app->session->getFlash('word')):?>
    <div class="alert alert-info" role="alert">
        <?= Yii::$app->session->getFlash('word');?>
    </div>
<?php endif;?>
<?= \yii\bootstrap\Html::a('Вернутись до проекту', ['/project/view', 'id'=>$comment->project_id], ['class'=>'btn btn-primary pull-left'])?>


