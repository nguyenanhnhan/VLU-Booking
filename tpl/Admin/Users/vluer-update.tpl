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
			<label for="addMSSV">{translate key="MSSV"}</label>
			<input type="text" {formname key="MSSV"} class="required form-control" disabled required
				   id="addMSSV" value="{$User->StudentMSSV()|escape:html}"/>

		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addFullname">{translate key="FullName"}</label>
			<input type="text" {formname key="FULLNAME"} class="required form-control" required
				   id="addFullname" value="{$User->StudentFullName()|escape:html}"/>
			<i class="glyphicon glyphicon-asterisk form-control-feedback"
			   data-bv-icon-for="addFullname"></i>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addEmail">{translate key="Email"}</label>
			<input type="text" {formname key="EMAIL"} class="required form-control" required
				   id="addEmail" value="{$User->StudentEmail()|escape:html}"/>
			<i class="glyphicon glyphicon-asterisk form-control-feedback"
			   data-bv-icon-for="addEmail"></i>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addMajorname">{translate key="MajorName"}</label>
			<input type="text" {formname key="MAJOR_NAME"} class="form-control"
				   id="addMajorname" value="{$User->StudentMajorName()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addStudentclass">{translate key="StudentClass"}</label>
			<input type="text" {formname key="STUDENT_CLASS"} class="form-control"
				   id="addStudentclass" value="{$User->StudentClass()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group">
			<label for="addStudenttype">{translate key="StudentType"}</label>
			<input type="text" {formname key="STUDENT_TYPE"} class="form-control" id="addStudenttype" value="{$User->StudentType()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">

		<div class="form-group">
			<label for="addStatus">{translate key="StudentStatus"}</label>
			<input type="text" {formname key="STUDENT_STATUS"} class="form-control" id="addStatus" value="{$User->StudentStatus()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">

		<div class="form-group">
			<label for="addDate">{translate key="EnrollmentDate"}</label>
			<input type="date" {formname key="ENROLLMENT_DATE"} class="form-control" id="addDate" value="{$User->EnrollmentDate()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">

		<div class="form-group">
			<label for="addTrainingprogram">{translate key="TrainingProgram"}</label>
			<input type="text" {formname key="TRAINING_PROGRAM"} class="form-control" id="addTrainingprogram" value="{$User->TrainingProgram()|escape:html}"/>
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

	{* {foreach from=$Attributes item=attribute}
		<div class="col-sm-12 col-md-6">
			{control type="AttributeControl" attribute=$attribute value={$User->GetAttributeValue($attribute->Id())} }
		</div>
	{/foreach} *}
		<div class="clearfix">&nbsp;</div>
</div>
