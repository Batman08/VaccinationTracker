SELECT *  FROM [Vaccinations].[dbo].[PatientsSample]

  select count(*) from PatientsSample


    
select * from Patients_male_first_names
select * from Patients_last_names

  select * from Patients_female_first_names

  Select ceiling(rand()*5408) as FirstNamePos, ceiling(rand()*88587) as LastNamePos


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


--update PatientsSample set FirstName = null, LastName = null 
--update PatientsSample set Age = null
--update PatientsSample set PatientUniqueId = null

select * from PatientsSample where FirstName is null or LastName is null

while (select count(*) from PatientsSample where age is null) > 0
begin
	update top(1) PatientsSample set Age = 12 + ceiling(rand()*90) where age is null
end

select NEWID()

select substring(CAST(NEWID() as nvarchar(36)),0, 9)

while (select count(*) from PatientsSample where PatientUniqueId is null) > 0
begin
	update top(1) PatientsSample set PatientUniqueId = substring(CAST(NEWID() as nvarchar(36)),0, 9) where PatientUniqueId is null
end

select PatientUniqueId from PatientsSample group by PatientUniqueId having count(*) > 1