<?php

use Controller\Template;

$template = new Template;

$template->setHeader('Header');
$template->setBody('Body');
$template->setFooter('Footer');
echo $template->getContent('Template');
