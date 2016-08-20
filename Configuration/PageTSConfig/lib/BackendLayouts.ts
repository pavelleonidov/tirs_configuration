mod {
	web_layout {
		BackendLayouts {
			Default {
				title = Default Layout
				config {
					backend_layout {
						colCount = 1
						rowCount = 2
						rows {
							1 {
								columns {
									1 {
										name = Visual
										colPos = 1
									}
								}
							}
							2 {
								columns {
									1 {
										name = Content
										colPos = 0
										colspan = 1
									}
								}
							}
						}
					}
				}
			}
		}
	}
}