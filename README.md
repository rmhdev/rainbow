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
