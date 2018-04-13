USE [master]
GO

/****** Object:  Database [yii2basic]    Script Date: 13/04/2018 16:02:20 ******/
DROP DATABASE [yii2basic]
GO

/****** Object:  Database [yii2basic]    Script Date: 13/04/2018 16:02:20 ******/
CREATE DATABASE [yii2basic]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'yii2basic', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.SQLEXPRESS\MSSQL\DATA\yii2basic.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'yii2basic_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.SQLEXPRESS\MSSQL\DATA\yii2basic_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO

ALTER DATABASE [yii2basic] SET COMPATIBILITY_LEVEL = 140
GO

IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [yii2basic].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO

ALTER DATABASE [yii2basic] SET ANSI_NULL_DEFAULT OFF 
GO

ALTER DATABASE [yii2basic] SET ANSI_NULLS OFF 
GO

ALTER DATABASE [yii2basic] SET ANSI_PADDING OFF 
GO

ALTER DATABASE [yii2basic] SET ANSI_WARNINGS OFF 
GO

ALTER DATABASE [yii2basic] SET ARITHABORT OFF 
GO

ALTER DATABASE [yii2basic] SET AUTO_CLOSE OFF 
GO

ALTER DATABASE [yii2basic] SET AUTO_SHRINK OFF 
GO

ALTER DATABASE [yii2basic] SET AUTO_UPDATE_STATISTICS ON 
GO

ALTER DATABASE [yii2basic] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO

ALTER DATABASE [yii2basic] SET CURSOR_DEFAULT  GLOBAL 
GO

ALTER DATABASE [yii2basic] SET CONCAT_NULL_YIELDS_NULL OFF 
GO

ALTER DATABASE [yii2basic] SET NUMERIC_ROUNDABORT OFF 
GO

ALTER DATABASE [yii2basic] SET QUOTED_IDENTIFIER OFF 
GO

ALTER DATABASE [yii2basic] SET RECURSIVE_TRIGGERS OFF 
GO

ALTER DATABASE [yii2basic] SET  DISABLE_BROKER 
GO

ALTER DATABASE [yii2basic] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO

ALTER DATABASE [yii2basic] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO

ALTER DATABASE [yii2basic] SET TRUSTWORTHY OFF 
GO

ALTER DATABASE [yii2basic] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO

ALTER DATABASE [yii2basic] SET PARAMETERIZATION SIMPLE 
GO

ALTER DATABASE [yii2basic] SET READ_COMMITTED_SNAPSHOT OFF 
GO

ALTER DATABASE [yii2basic] SET HONOR_BROKER_PRIORITY OFF 
GO

ALTER DATABASE [yii2basic] SET RECOVERY SIMPLE 
GO

ALTER DATABASE [yii2basic] SET  MULTI_USER 
GO

ALTER DATABASE [yii2basic] SET PAGE_VERIFY CHECKSUM  
GO

ALTER DATABASE [yii2basic] SET DB_CHAINING OFF 
GO

ALTER DATABASE [yii2basic] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO

ALTER DATABASE [yii2basic] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO

ALTER DATABASE [yii2basic] SET DELAYED_DURABILITY = DISABLED 
GO

ALTER DATABASE [yii2basic] SET QUERY_STORE = OFF
GO

USE [yii2basic]
GO

ALTER DATABASE SCOPED CONFIGURATION SET IDENTITY_CACHE = ON;
GO

ALTER DATABASE SCOPED CONFIGURATION SET LEGACY_CARDINALITY_ESTIMATION = OFF;
GO

ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET LEGACY_CARDINALITY_ESTIMATION = PRIMARY;
GO

ALTER DATABASE SCOPED CONFIGURATION SET MAXDOP = 0;
GO

ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET MAXDOP = PRIMARY;
GO

ALTER DATABASE SCOPED CONFIGURATION SET PARAMETER_SNIFFING = ON;
GO

ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET PARAMETER_SNIFFING = PRIMARY;
GO

ALTER DATABASE SCOPED CONFIGURATION SET QUERY_OPTIMIZER_HOTFIXES = OFF;
GO

ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET QUERY_OPTIMIZER_HOTFIXES = PRIMARY;
GO

ALTER DATABASE [yii2basic] SET  READ_WRITE 
GO

