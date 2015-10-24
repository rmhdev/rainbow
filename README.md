# rainbow
Immutable colors


Alpha compositing: http://www.w3.org/TR/compositing-1/#simplealphacompositing
http://www.w3.org/TR/SVG11/masking.html#SimpleAlphaBlending

Er, Eg, Eb    - Element color value
Ea            - Element alpha value
Cr, Cg, Cb    - Canvas color value (before blending)
Ca            - Canvas alpha value (before blending)
Cr', Cg', Cb' - Canvas color value (after blending)
Ca'           - Canvas alpha value (after blending)

Ca' = 1 - (1 - Ea) * (1 - Ca)


## About color transformation

| RGB           | HEX     | HSL           |
| ------------- | ------- | ------------- |
| rgb(45,45,45) | #2d2d2d | hsl(0,0%,18%) |
| rgb(46,46,46) | #2e2e2e | hsl(0,0%,18%) |
| rgb(47,47,47) | #2f2f2f | hsl(0,0%,18%) |

