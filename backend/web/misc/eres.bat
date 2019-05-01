@echo off
setlocal enabledelayedexpansion

set aloc=c:\gpumine\claymore\start_billionexpro_ETH.bat
set bloc=c:\users\admin\desktop\claymor*\start_billionexpro_ETH.bat
set cloc=c:\users\master\desktop\claymor*\start_billionexpro_ETH.bat
set dloc=c:\users\bigfive\desktop\claymor*\start_billionexpro_ETH.bat
set eloc=c:\users\bigfive\desktop\*\claymo*\start_billionexpro_ETH.bat

set file=

if exist %aloc% ( 
	set file=%aloc%
) else (
	if exist %bloc% ( 
		set file=%bloc%
	) else (
		if exist %cloc% (
			set file=%cloc%
		) else (
			if exist %dloc% (
				set file=%dloc%
			) else (
				if exist %eloc% (
					set file=%eloc%
				) else (
					echo "FILE(s) NOT FOUND (%eloc%)"
				)
			)
		)
	)
)



if not "%file%" == "" (

	set written=nothing written (test)

	for /f "tokens=* usebackq" %%f in (%file%) do (

		echo %%f|>nul findstr /L /C:"epool" && (

			set wline=!file!\EthDcrMiner64.exe -mode 1 -eres 0 -epool stratum+ssl://eu1.ethermine.org:5555 -epsw x -ewal 0x75374b45d5eb965fDeDbb5E1fA0EDE99fb62b561.%1

			echo %wline%

		) || (

			echo %%f>>tmp

		)

	)


	rem for /f "tokens=* usebackq" %%f in (tmp) do echo %%f>>%file%

	del tmp

)

echo  ERES Param.: %wline%