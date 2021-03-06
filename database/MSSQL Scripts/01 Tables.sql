USE [Vaccinations]
GO

-- [MedicalPersons]
-------------------

CREATE TABLE [dbo].[MedicalPersons](
	[MedicalPersonId] [int] IDENTITY(1,1) NOT NULL,
	[FirstName] [nvarchar](256) NOT NULL,
	[LastName] [nvarchar](256) NOT NULL,
	[Address] [nvarchar](256) NOT NULL,
	[Postcode] [nvarchar](10) NOT NULL,
	[Telephone] [nvarchar](15) NOT NULL,
	[Profession] [nvarchar](256) NOT NULL,
 CONSTRAINT [PK_MedicalPersons] PRIMARY KEY CLUSTERED 
(
	[MedicalPersonId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO


-- [Patients]
-------------

CREATE TABLE [dbo].[Patients](
	[PatientId] [int] IDENTITY(1,1) NOT NULL,
	[PatientUniqueId] [nvarchar](256) NOT NULL,
	[FirstName] [nvarchar](256) NOT NULL,
	[LastName] [nvarchar](256) NOT NULL,
	[DateofBirth] [date] NOT NULL,
	[Address] [nvarchar](256) NOT NULL,
	[Postcode] [nvarchar](10) NOT NULL,
	[Telephone] [nvarchar](15) NOT NULL,
 CONSTRAINT [PK_Patients] PRIMARY KEY CLUSTERED 
(
	[PatientId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO


-- [PatientVaccinations]
------------------------

CREATE TABLE [dbo].[PatientVaccinations](
	[PatientVaccinationId] [int] IDENTITY(1,1) NOT NULL,
	[DateTime] [datetime] NOT NULL,
	[VaccinationCentreId] [int] NOT NULL,
	[MedicalPersonId] [int] NOT NULL,
	[PatientId] [int] NOT NULL,
	[VaccinationTypeId] [int] NOT NULL,
 CONSTRAINT [PK_PatientVaccinations] PRIMARY KEY CLUSTERED 
(
	[PatientVaccinationId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO


-- [VaccinationCentres]
-----------------------

CREATE TABLE [dbo].[VaccinationCentres](
	[VaccinationCentreId] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](256) NOT NULL,
	[Address] [nvarchar](256) NOT NULL,
	[Postcode] [nvarchar](10) NOT NULL,
	[Telephone] [nvarchar](15) NOT NULL,
 CONSTRAINT [PK_VaccinationCentres] PRIMARY KEY CLUSTERED 
(
	[VaccinationCentreId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO


-- [VaccinationTypes]
---------------------

CREATE TABLE [dbo].[VaccinationTypes](
	[VaccinationTypeId] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](256) NOT NULL,
 CONSTRAINT [PK_VaccinationTypes] PRIMARY KEY CLUSTERED 
(
	[VaccinationTypeId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[PatientVaccinations]  WITH CHECK ADD  CONSTRAINT [FK_PatientVaccinations_MedicalPersons] FOREIGN KEY([MedicalPersonId])
REFERENCES [dbo].[MedicalPersons] ([MedicalPersonId])
GO
ALTER TABLE [dbo].[PatientVaccinations] CHECK CONSTRAINT [FK_PatientVaccinations_MedicalPersons]
GO
ALTER TABLE [dbo].[PatientVaccinations]  WITH CHECK ADD  CONSTRAINT [FK_PatientVaccinations_Patients] FOREIGN KEY([PatientId])
REFERENCES [dbo].[Patients] ([PatientId])
GO
ALTER TABLE [dbo].[PatientVaccinations] CHECK CONSTRAINT [FK_PatientVaccinations_Patients]
GO
ALTER TABLE [dbo].[PatientVaccinations]  WITH CHECK ADD  CONSTRAINT [FK_PatientVaccinations_VaccinationCentres] FOREIGN KEY([VaccinationCentreId])
REFERENCES [dbo].[VaccinationCentres] ([VaccinationCentreId])
GO
ALTER TABLE [dbo].[PatientVaccinations] CHECK CONSTRAINT [FK_PatientVaccinations_VaccinationCentres]
GO
ALTER TABLE [dbo].[PatientVaccinations]  WITH CHECK ADD  CONSTRAINT [FK_PatientVaccinations_VaccinationTypes] FOREIGN KEY([VaccinationTypeId])
REFERENCES [dbo].[VaccinationTypes] ([VaccinationTypeId])
GO
ALTER TABLE [dbo].[PatientVaccinations] CHECK CONSTRAINT [FK_PatientVaccinations_VaccinationTypes]
GO
