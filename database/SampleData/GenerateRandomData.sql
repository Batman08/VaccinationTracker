SELECT *  FROM [Vaccinations].[dbo].[PatientsSample]

-- Male Names
declare @i int  = 0
while @i < 5000
begin
	declare @firstName nvarchar(256) = (select text from Patients_male_first_names where pos = ceiling(rand()*5400))
	declare @lastName nvarchar(256) = (select text from Patients_last_names where pos = 1 + ceiling(rand()*88580))

	update top (1) PatientsSample set FirstName = @firstName, LastName = @lastName where FirstName is null and LastName is null

	set @i = @i + 1
end
GO

-- Female Names
declare @i int  = 0
while @i < 5500
begin
	declare @firstName nvarchar(256) = (select text from Patients_female_first_names where pos = ceiling(rand()*9640))
	declare @lastName nvarchar(256) = (select text from Patients_last_names where pos = 1 + ceiling(rand()*88580))

	update top (1) PatientsSample set FirstName = @firstName, LastName = @lastName where FirstName is null and LastName is null

	set @i = @i + 1
end
GO

-- Age
while (select count(*) from PatientsSample where age is null) > 0
begin
	update top(1) PatientsSample set Age = 12 + ceiling(rand()*90) where age is null
end

-- Patient Unique Id
while (select count(*) from PatientsSample where PatientUniqueId is null) > 0
begin
	update top(1) PatientsSample set PatientUniqueId = substring(CAST(NEWID() as nvarchar(36)),0, 9) where PatientUniqueId is null
end

-- Insert data from PatientsSample table into Patients table
insert into Patients (PatientUniqueId, FirstName, LastName, Age, [Address], Postcode, Telephone)
select PatientUniqueId, FirstName, LastName, Age, [Address], Postcode, Phone_number
from PatientsSample


--select * from Patients
--select * from PatientsSample