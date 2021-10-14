@props(['size' => 35, 'color' => 'gray'])

@php
    switch ($color) {
        case 'gray':
                $col = "#374751";
            break;
        case 'white':
                $col = "#FFFFFF";
            break;
        
        default:
                $col = "#374751";
            break;
    }
@endphp

<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="{{$size}}" height="{{$size}}" viewBox="0 0 172 172"
    style=" fill:#000000;">
    <defs>
        <linearGradient x1="126.3125" y1="119.59375" x2="126.3125" y2="143.35125" gradientUnits="userSpaceOnUse"
            id="color-1_o4V4IXgZasg6_gr1">
            <stop offset="0" stop-color="#70dfff"></stop>
            <stop offset="1" stop-color="#70afff"></stop>
        </linearGradient>
        <linearGradient x1="77.9375" y1="119.59375" x2="77.9375" y2="143.35125" gradientUnits="userSpaceOnUse"
            id="color-2_o4V4IXgZasg6_gr2">
            <stop offset="0" stop-color="#70dfff"></stop>
            <stop offset="1" stop-color="#70afff"></stop>
        </linearGradient>
        <linearGradient x1="102.125" y1="14.69525" x2="102.125" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-3_o4V4IXgZasg6_gr3">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
        <linearGradient x1="104.8125" y1="14.69525" x2="104.8125" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-4_o4V4IXgZasg6_gr4">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
        <linearGradient x1="86" y1="14.69525" x2="86" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-5_o4V4IXgZasg6_gr5">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
        <linearGradient x1="25.53125" y1="14.69525" x2="25.53125" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-6_o4V4IXgZasg6_gr6">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
        <linearGradient x1="30.90625" y1="14.69525" x2="30.90625" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-7_o4V4IXgZasg6_gr7">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
        <linearGradient x1="38.96875" y1="14.69525" x2="38.96875" y2="144.90463" gradientUnits="userSpaceOnUse"
            id="color-8_o4V4IXgZasg6_gr8">
            <stop offset="0" stop-color="#00c6ff"></stop>
            <stop offset="1" stop-color="#0072ff"></stop>
        </linearGradient>
    </defs>
    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
        stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <path d="M0,172v-172h172v172z" fill="none"></path>
        <g id="Layer_2">
            <path
                d="M137.0625,131.6875c0,5.9125 -4.8375,10.75 -10.75,10.75c-5.9125,0 -10.75,-4.8375 -10.75,-10.75c0,-5.9125 4.8375,-10.75 10.75,-10.75c5.9125,0 10.75,4.8375 10.75,10.75z"
                fill="url(#color-1_o4V4IXgZasg6_gr1)"></path>
            <path
                d="M88.6875,131.6875c0,5.9125 -4.8375,10.75 -10.75,10.75c-5.9125,0 -10.75,-4.8375 -10.75,-10.75c0,-5.9125 4.8375,-10.75 10.75,-10.75c5.9125,0 10.75,4.8375 10.75,10.75z"
                fill="url(#color-2_o4V4IXgZasg6_gr2)"></path>
            <path
                d="M126.3125,118.25c-6.45,0 -11.825,4.56875 -13.16875,10.75h-22.0375c-1.34375,-6.18125 -6.71875,-10.75 -13.16875,-10.75c-7.525,0 -13.4375,5.9125 -13.4375,13.4375c0,7.525 5.9125,13.4375 13.4375,13.4375c6.45,0 11.825,-4.56875 13.16875,-10.75h22.0375c1.34375,6.18125 6.71875,10.75 13.16875,10.75c7.525,0 13.4375,-5.9125 13.4375,-13.4375c0,-7.525 -5.9125,-13.4375 -13.4375,-13.4375zM77.9375,139.75c-4.56875,0 -8.0625,-3.49375 -8.0625,-8.0625c0,-4.56875 3.49375,-8.0625 8.0625,-8.0625c4.56875,0 8.0625,3.49375 8.0625,8.0625c0,4.56875 -3.49375,8.0625 -8.0625,8.0625zM126.3125,139.75c-4.56875,0 -8.0625,-3.49375 -8.0625,-8.0625c0,-4.56875 3.49375,-8.0625 8.0625,-8.0625c4.56875,0 8.0625,3.49375 8.0625,8.0625c0,4.56875 -3.49375,8.0625 -8.0625,8.0625z"
                fill="url(#color-3_o4V4IXgZasg6_gr3)"></path>
            <rect x="30" y="33" transform="scale(2.6875,2.6875)" width="18" height="2"
                fill="url(#color-4_o4V4IXgZasg6_gr4)"></rect>
            <path
                d="M147.8125,51.0625h-89.225l-4.03125,-18.00625c-0.80625,-3.49375 -4.03125,-6.18125 -7.79375,-6.18125h-22.575c-4.56875,0 -8.0625,3.49375 -8.0625,8.0625c0,4.56875 3.49375,8.0625 8.0625,8.0625h10.75c4.56875,0 8.0625,-3.49375 8.0625,-8.0625v-2.6875h3.7625c1.34375,0 2.41875,0.80625 2.6875,2.15l13.4375,59.93125c1.34375,6.18125 6.71875,10.48125 13.16875,10.48125h58.31875c5.9125,0 11.2875,-4.03125 12.9,-9.675l8.0625,-28.4875c0.26875,-1.075 0.5375,-2.41875 0.5375,-3.7625v-3.7625c0,-4.56875 -3.49375,-8.0625 -8.0625,-8.0625zM37.625,34.9375c0,1.6125 -1.075,2.6875 -2.6875,2.6875h-10.75c-1.6125,0 -2.6875,-1.075 -2.6875,-2.6875c0,-1.6125 1.075,-2.6875 2.6875,-2.6875h13.4375zM150.5,62.8875c0,0.80625 0,1.6125 -0.26875,2.15l-8.0625,28.4875c-1.075,3.49375 -4.3,5.9125 -7.79375,5.9125h-58.5875c-3.7625,0 -6.9875,-2.6875 -7.79375,-6.18125l-8.0625,-36.81875h87.88125c1.6125,0 2.6875,1.075 2.6875,2.6875z"
                fill="url(#color-5_o4V4IXgZasg6_gr5)"></path>
            <rect x="2" y="22" transform="scale(2.6875,2.6875)" width="15" height="2"
                fill="url(#color-6_o4V4IXgZasg6_gr6)"></rect>
            <rect x="4" y="28" transform="scale(2.6875,2.6875)" width="15" height="2"
                fill="url(#color-7_o4V4IXgZasg6_gr7)"></rect>
            <rect x="8" y="34" transform="scale(2.6875,2.6875)" width="13" height="2"
                fill="url(#color-8_o4V4IXgZasg6_gr8)"></rect>
        </g>
    </g>
</svg>
