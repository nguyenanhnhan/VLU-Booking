<div>
	<div id="updateUserResults" class="alert alert-danger no-show validationSummary">
		<ul>
            {async_validator id="emailformat" key="ValidEmailRequired"}
            {async_validator id="uniqueemail" key="UniqueEmailRequired"}
            {async_validator id="uniqueusername" key="UniqueUsernameRequired"}
            {async_validator id="updateAttributeValidator" key=""}
		</ul>
	</div>
	<div class="col-sm-12 col-md-6">

		<div class="form-group has-feedback">
			<label for="addLecturerId">{translate key="LecturerId"}</label>
			<input type="text" {formname key="LECTURER_ID"} class="required form-control" disabled required
				   id="addLecturerId" value="{$User->LecturerId()|escape:html}"/>

		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addFullname">{translate key="FullName"}</label>
			<input type="text" {formname key="FULLNAME"} class="required form-control" required
				   id="addFullname" value="{$User->LecturerFullName()|escape:html}"/>
			<i class="glyphicon glyphicon-asterisk form-control-feedback"
			   data-bv-icon-for="addFullname"></i>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group">
			<label for="addHireDate">{translate key="HireDate"}</label>
			<input type="date" {formname key="LECTURER_HIRE_DATE"} class="form-control" id="addHireDate" value="{$User->HireDate()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group">
			<label for="addPhoneNumber">{translate key="PhoneNumber"}</label>
			<input type="text" {formname key="LECTURER_PHONE_NUMBER"} class="form-control" id="addPhoneNumber" value="{$User->PhoneNumber()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addDepartment">{translate key="Department"}</label>
			{if $Departments|@count > 0}
				<select {formname key='DEPARTMENT_ID'} id='addDepartment' class="form-control">
					<option value="">{translate key=None}</option>
					{html_options options=$Departments selected=$User->DepartmentId()}
				</select>
			{else}
				<select {formname key='DEPARTMENT_ID'} id='addDepartment' class="form-control" disabled>
					<option value="">{translate key="NoDepartmentsAvailable"}</option>
				</select>
			{/if}
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addEmail">{translate key="Email"}</label>
			<input type="text" {formname key="EMAIL"} class="required form-control" required
				   id="addEmail" value="{$User->LecturerEmail()|escape:html}"/>
			<i class="glyphicon glyphicon-asterisk form-control-feedback"
			   data-bv-icon-for="addEmail"></i>
		</div>
	</div>

	{* {foreach from=$Attributes item=attribute}
		<div class="col-sm-12 col-md-6">
			{control type="AttributeControl" attribute=$attribute value={$User->GetAttributeValue($attribute->Id())} }
		</div>
	{/foreach} *}
		<div class="clearfix">&nbsp;</div>
</div>
