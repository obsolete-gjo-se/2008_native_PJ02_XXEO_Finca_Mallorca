' VB Script Document

option explicit
Dim iim1, iret, ScriptPosValue
Dim ExtractedValue

set iim1 = CreateObject ("google5.iim")
iret = iim1.iimInit ("")
iret = iim1.iimPlay ("http://www.google.de")

ScriptPOSValue = 1

Do
	iret = iim1.iimSet ("-var_MacroPOSvalue", ScriptPOSValue)
	iret = iim.iimPlay ("RateExtraction")
	ExtrectedValue = Replace (iim1.iimGetLastExtrect (), "[EXTRACT]", "")
	MsgBox (ExtractedValue)
	ScriptPOSValue = ScriptPOSValue + 4
Loop Until ExtractedValue ="#EANF#"

iret = iim1.iimExit(1)
WScript.Quit(0)