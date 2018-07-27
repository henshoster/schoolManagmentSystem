<?php
foreach ($dirtree as $key => $value) {
    if (is_array($value)) {?>
        <li>
            <a data-toggle="collapse" href="#<?="$key$uniqueCounter"?>" role="button" aria-expanded="false">
                <?=$key?>
            </a>
            <ul class="collapse" id="<?="$key$uniqueCounter"?>">
                <?=$this->treePrint($value, $uniqueCounter++)?>
            </ul>
        </li>
    <?php } else {?>
        <li class="no-li-style">
            <?=$value?>
        </li>
    <?php }
}