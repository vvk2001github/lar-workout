<?php

function exTypeToString(int $type):string {

    switch ($type) {
        case 0:
            return __('exmessages.Type0');
        case 1:
            return __('exmessages.Type1');
        case 2:
            return __('exmessages.Type2');
        case 3:
            return __('exmessages.Type3');
        default:
            return __('exmessages.TypeUndefined');
    }
}
