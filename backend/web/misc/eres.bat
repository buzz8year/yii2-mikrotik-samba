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

	set written=nothing; parameter already set

	for /f "tokens=* usebackq" %%f in (%file%) do (
		
		echo %%f|>nul findstr /L /C:"epool" && (

			echo %%f|>nul findstr /L /C:"eres" && (

				echo %%f>>tmp

			) || (

				set line=%%f -eres 0

			  	echo !line!>>tmp

				set written=!line!

			)

		) || (

			echo %%f>>tmp

		)

	)


	>%file% echo setx GPU_FORCE_64BIT_PTR 0
	>>%file% echo setx GPU_MAX_HEAP_SIZE 100
	>>%file% echo setx GPU_USE_SYNC_OBJECTS 1
	>>%file% echo setx GPU_MAX_ALLOC_PERCENT 100
	>>%file% echo setx GPU_SINGLE_ALLOC_PERCENT 100


	for /f "tokens=* usebackq" %%f in (tmp) do echo %%f>>%file%

	del tmp

)

echo CHANGES APPLIED: %written%