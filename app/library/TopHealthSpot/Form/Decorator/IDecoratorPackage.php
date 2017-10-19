<?php
interface TopHealthSpot_Form_Decorator_IDecoratorPackage
{
	public function getHiddenElementDecorators();
	public function getButtonElementDecorators();
	public function getJQueryElementDecorators();
	public function getFileElementDecorators();
	public function getFormDecorators();
	public function getPlainTextDecorators();
	public function getGeneralElementDecorators();
	public function getCheckboxElementDecorators();
	
}